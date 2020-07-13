package com.tarks.ocrtest4;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.KeyEvent;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ListView;
import android.widget.Toast;

import org.apache.http.util.EncodingUtils;

import java.util.HashMap;
import java.util.List;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

public class website extends AppCompatActivity
{

    private WebView webView;
    private WebSettings mWebSettings; //웹뷰세팅

    SessionManager sessionManager; // 전역에서 사용하기 위해 세션 선언


    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tradelist_view);

        sessionManager = new SessionManager(this); // 세션 생성
        sessionManager.checkLogin(); // 로그인 되어있는지 체크함
        HashMap<String, String> user = sessionManager.getUserDetail(); // user 라는 해시맵을 만들어서 세션값을 관리함
        String uId = user.get(sessionManager.ID); // mId에 현재 로그인한 사용자 정보를 저장함
        String uPass = user.get(sessionManager.PASSWORD);

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

        String url = "http://54.175.31.167";

        String postData = "uId=" + uId + "&uPass=" + uPass; // 웹뷰로 아이디 전송
        // String param = "arg0=123&arg1=222";
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
}
