package com.tarks.ocrtest4;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;

import org.apache.http.util.EncodingUtils;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.HashMap;

public class ScanQR extends AppCompatActivity {

    private WebView mWebView; // 웹뷰 선언
    private WebSettings mWebSettings; //웹뷰세팅
    SessionManager sessionManager; // 전역에서 사용하기 위해 세션 선언

    String mId; // 상대방 연락처 아이디
    String u_id; // 내 아이디


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_scanqr);

        sessionManager = new SessionManager(this); // 세션 생성
        sessionManager.checkLogin(); // 로그인 되어있는지 체크함
        HashMap<String, String> user = sessionManager.getUserDetail(); // user 라는 해시맵을 만들어서 세션값을 관리함
        u_id = user.get(sessionManager.ID); // mId에 현재 로그인한 사용자 정보를 저장함

        // Toast.makeText(getApplicationContext(), u_id, Toast.LENGTH_SHORT).show();



        new IntentIntegrator(this).initiateScan();

        mWebView = (WebView) findViewById(R.id.webView);

        mWebView.setWebViewClient(new WebViewClient()); // 클릭시 새창 안뜨게
        mWebSettings = mWebView.getSettings(); //세부 세팅 등록
        mWebSettings.setJavaScriptEnabled(true); // 웹페이지 자바스클비트 허용 여부
        mWebSettings.setSupportMultipleWindows(false); // 새창 띄우기 허용 여부
        mWebSettings.setJavaScriptCanOpenWindowsAutomatically(false); // 자바스크립트 새창 띄우기(멀티뷰) 허용 여부
        mWebSettings.setLoadWithOverviewMode(true); // 메타태그 허용 여부
        mWebSettings.setUseWideViewPort(true); // 화면 사이즈 맞추기 허용 여부
        mWebSettings.setSupportZoom(false); // 화면 줌 허용 여부
        mWebSettings.setBuiltInZoomControls(false); // 화면 확대 축소 허용 여부
        mWebSettings.setLayoutAlgorithm(WebSettings.LayoutAlgorithm.SINGLE_COLUMN); // 컨텐츠 사이즈 맞추기
        mWebSettings.setCacheMode(WebSettings.LOAD_NO_CACHE); // 브라우저 캐시 허용 여부
        mWebSettings.setDomStorageEnabled(true); // 로컬저장소 허용 여부
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        IntentResult result = IntentIntegrator.parseActivityResult(requestCode, resultCode, data);
        if (result != null) {
            if (result.getContents() == null) {
                Toast.makeText(this, "Cancelled", Toast.LENGTH_LONG).show();
                // todo
            } else {
                String a = result.getContents(); // 문자열 가져옴
                String[] splitText = a.split("-");

                mId = splitText[1];

                ScanQR.registDB rdb = new ScanQR.registDB(); // 테이블에 상대방 연락처 정보를 저장함
                rdb.execute();

                String postData = "mId=" + mId; // 웹뷰로 아이디 전송
                mWebView.postUrl(splitText[0], EncodingUtils.getBytes(postData, "BASE64")); // 웹뷰 데이터 넘기기
                // mWebView.loadUrl(splitText[0]); // 웹뷰에 표시할 웹사이트 주소, 웹뷰 시작
                // todo
            }
        } else {
            super.onActivityResult(requestCode, resultCode, data);
        }
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