package com.tarks.ocrtest4;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.KeyEvent;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
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
import java.util.HashMap;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

public class bluetooth_web extends AppCompatActivity
{

    private WebView webView;
    private WebSettings mWebSettings; //웹뷰세팅


    SessionManager sessionManager; // 전역에서 사용하기 위해 세션 선언


    String mId; // 상대방 연락처 아이디
    String u_id; // 내 아이디


    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bluetooth_web);

        sessionManager = new SessionManager(this); // 세션 생성
        sessionManager.checkLogin(); // 로그인 되어있는지 체크함
        HashMap<String, String> user = sessionManager.getUserDetail(); // user 라는 해시맵을 만들어서 세션값을 관리함
        u_id = user.get(sessionManager.ID); // mId에 현재 로그인한 사용자 정보를 저장함

        webView = (WebView) findViewById(R.id.webView);
        webView.getSettings().setJavaScriptEnabled(true);

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


        //Toast.makeText(getApplicationContext(), "트레이브 뷰입니다", Toast.LENGTH_SHORT).show();
        Intent intent = getIntent(); /*데이터 수신*/
        mId = intent.getExtras().getString("userid"); /*String형*/

        String url = "http://54.175.31.167/template_page/repre_template";

        bluetooth_web.registDB rdb = new bluetooth_web.registDB(); // 테이블에 상대방 연락처 정보를 저장함
        rdb.execute();

        String postData = "mId=" + mId; // 웹뷰로 아이디 전송
        webView.postUrl(url, EncodingUtils.getBytes(postData, "BASE64")); // 웹뷰 데이터 넘기기
    }

    //key down
    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event){
        if((keyCode == KeyEvent.KEYCODE_BACK) && webView.canGoBack() ){
            webView.goBack();
            return true;
        }

        //백할 페이가 없다면
        if ((keyCode == KeyEvent.KEYCODE_BACK) && (webView.canGoBack() == false)){

            //다이아로그박스 출력
            new AlertDialog.Builder(this)
                    .setTitle("메인 화면으로")
                    .setMessage("메인 화면으로 돌아가시겠습니까?")
                    .setPositiveButton("예", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            finish();
                        }
                    })
                    .setNegativeButton("아니오",  null).show();
        }

        return super.onKeyDown(keyCode, event);
    }

    public class registDB extends AsyncTask<Void, Integer, Void> {

        @Override
        protected Void doInBackground(Void... unused) {

            /* 인풋 파라메터값 생성 */
            String param = "uid=" + u_id + "&mId=" + mId + "";

            try {
                /* 서버연결 */
                URL url = new URL(
                        "http://52.205.255.37/move/meishi_list.php");
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
                conn.setRequestMethod("POST");
                conn.setDoInput(true);
                conn.connect();

                /* 안드로이드 -> 서버 파라메터값 전달 */
                OutputStream outs = conn.getOutputStream();
                outs.write(param.getBytes("UTF-8"));
                outs.flush();
                outs.close();

                /* 서버 -> 안드로이드 파라메터값 전달 */
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
                    Log.e("RESULT","성공적으로 처리되었습니다!");
                    Handler mHandler = new Handler(Looper.getMainLooper());
                    mHandler.postDelayed(new Runnable() {
                        @Override
                        public void run() {
                            // 사용하고자 하는 코드
                            Toast.makeText(getApplicationContext(), "연락처 정보 저장 완료", Toast.LENGTH_SHORT).show();
                        }
                    }, 0);

                }
                else
                {
                    Log.e("RESULT","에러 발생! ERRCODE = " + data);
                }

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            return null;

        }

    }
}
