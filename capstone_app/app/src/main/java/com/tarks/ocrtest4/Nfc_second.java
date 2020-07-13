package com.tarks.ocrtest4;

import android.app.Activity;
import android.content.Intent;
import android.nfc.NdefMessage;
import android.nfc.NdefRecord;
import android.nfc.NfcAdapter;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.os.Parcelable;
import android.util.Log;
import android.view.KeyEvent;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.util.EncodingUtils;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.Arrays;
import java.util.HashMap;

public class Nfc_second extends Activity
{
    TextView text;               // 텍스뷰변수
    int j;
    private WebView webView;
    private WebSettings mWebSettings; //웹뷰세팅
    String mId;
    String u_id; // 내아이디
    SessionManager sessionManager; // 전역에서사용하기위해세션선언
    @Override

    public void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nfc_second);
// TODO Auto-generated method stub

        text = (TextView) findViewById(R.id.text);                  //TextView 등록

        webView = (WebView) findViewById(R.id.webView);
        webView.getSettings().setJavaScriptEnabled(true);

        sessionManager = new SessionManager(this); // 세션생성
        sessionManager.checkLogin(); // 로그인되어있는지체크함
        HashMap<String, String> user = sessionManager.getUserDetail(); // user 라는해시맵을만들어서세션값을관리함
        u_id = user.get(sessionManager.ID); // mId에현재로그인한사용자정보를저장함


        webView.setWebViewClient(new WebViewClient()); // 클릭시새창안뜨게
        mWebSettings = webView.getSettings(); //세부세팅등록
        mWebSettings.setJavaScriptEnabled(true); // 웹페이지자바스클비트허용여부
        mWebSettings.setSupportMultipleWindows(false); // 새창띄우기허용여부
        mWebSettings.setJavaScriptCanOpenWindowsAutomatically(false); // 자바스크립트새창띄우기(멀티뷰) 허용여부
        mWebSettings.setLoadWithOverviewMode(true); // 메타태그허용여부
        mWebSettings.setUseWideViewPort(true); // 화면사이즈맞추기허용여부
        mWebSettings.setSupportZoom(false); // 화면줌허용여부
        mWebSettings.setBuiltInZoomControls(false); // 화면확대축소허용여부
        mWebSettings.setLayoutAlgorithm(WebSettings.LayoutAlgorithm.SINGLE_COLUMN); // 컨텐츠사이즈맞추기
        mWebSettings.setCacheMode(WebSettings.LOAD_NO_CACHE); // 브라우저캐시허용여부
        mWebSettings.setDomStorageEnabled(true); // 로컬저장소허용여부

        Intent passedIntent = getIntent();                              //intent 값을받아들인다.
        if(passedIntent != null)
        {
            onNewIntent(passedIntent); // 데이터를글씨로변환후띄우는메소드
        }

    }
    protected void onNewIntent(Intent intent)
    { //테그데이터를전달받았을때태그정보를화면에보여줌.

        String s = ""; // 글씨를띄우는데사용
        Parcelable[] data = intent.getParcelableArrayExtra(NfcAdapter.EXTRA_NDEF_MESSAGES); // EXTRA_NDEF_MESSAGES : 여분의배열이태그에존재한다.
        /*

         * 조건이널이아닌경우에글씨& 그림으로변환작업을한다.

         * 널인경우에는메소드가작동하지않는다.

         */
        if(data != null)
        {
            /*

             * 이러한처리르한다.

             * 이러한처리에서벗어나면예외처리를통해출력해준다.

             */
            try
            {

                for (int i =0; i<data.length; i++)
                {
                    NdefRecord[] recs = ((NdefMessage)data[i]).getRecords();
                    for(j = 0; j<recs.length; j++)
                    {
                        /*

                         * byte로날라온텍스트처리

                         */
                        if(recs[j].getTnf() == NdefRecord.TNF_WELL_KNOWN && Arrays.equals(recs[j].getType(), NdefRecord.RTD_TEXT))
                        {
                            byte[] payload = recs[j].getPayload();
                            String textEncoding = ((payload[0] & 0200)==0)?"UTF-8":"UTF-16";
                            int langCodeLen = payload[0] & 0077;
                            s += ("\n"+ new String(payload, langCodeLen + 1, payload.length - langCodeLen -1, textEncoding));

                            String[] splitText = s.split("-");

                            mId = splitText[1];

                            Nfc_second.registDB rdb = new Nfc_second.registDB(); // 테이블에상대방연락처정보를저장함
                            rdb.execute();


                            String url = "http://54.175.31.167/template_page/repre_template";
                            String postData = "mId=" + URLEncoder.encode(mId, "UTF-8");
                            webView.postUrl(url,postData.getBytes());
                        }

                    }

                }

            }
            catch(Exception e)
            {
                Log.e("TagDispatch", e.toString());
            }
        }



    }

    public class registDB extends AsyncTask<Void, Integer, Void> {

        @Override
        protected Void doInBackground(Void... unused) {

            /* 인풋파라메터값생성*/
            String param = "uid=" + u_id + "&mId=" + mId + "";

            try {
                /* 서버연결*/
                URL url = new URL(
                        "http://52.205.255.37/move/meishi_list.php");
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
                conn.setRequestMethod("POST");
                conn.setDoInput(true);
                conn.connect();

                /* 안드로이드-> 서버파라메터값전달*/
                OutputStream outs = conn.getOutputStream();
                outs.write(param.getBytes("UTF-8"));
                outs.flush();
                outs.close();

                /* 서버-> 안드로이드파라메터값전달*/
                InputStream is = null;
                BufferedReader in = null;
                String data = "";

                is = conn.getInputStream();
                in = new BufferedReader(new InputStreamReader(is), 8 * 1024);
                String line = null;
                StringBuffer buff = new StringBuffer();

                while ( ( line = in.readLine() ) != null )
                {
                    buff.append(line + "\n");
                }
                data = buff.toString().trim();
                Log.e("RECV DATA",data);

                if(data.equals("0000"))
                {
                    Log.e("RESULT","성공적으로처리되었습니다!");
                    Handler mHandler = new Handler(Looper.getMainLooper());
                    mHandler.postDelayed(new Runnable() {
                        @Override
                        public void run() {
// 사용하고자하는코드
                            Toast.makeText(getApplicationContext(), "연락처정보저장완료", Toast.LENGTH_SHORT).show();
                        }
                    }, 0);

                }
                else
                {
                    Log.e("RESULT","에러발생! ERRCODE = " + data);
                }

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            return null;

        }

    }

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event)
    {
        if ((keyCode == KeyEvent.KEYCODE_BACK) && webView.canGoBack())
        {
            webView.goBack();
            return true;
        }
        return super.onKeyDown(keyCode, event);
    }
}

