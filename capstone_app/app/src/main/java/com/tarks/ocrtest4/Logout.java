package com.tarks.ocrtest4;

import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import java.util.HashMap;

public class Logout extends AppCompatActivity {

    SessionManager sessionManager; // 전역에서 사용하기 위해 세션 선언
    Context context = this;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        sessionManager = new SessionManager(this); // 세션 생성
        sessionManager.checkLogin(); // 로그인 되어있는지 체크함
        HashMap<String, String> user = sessionManager.getUserDetail(); // user 라는 해시맵을 만들어서 세션값을 관리함
        String mId = user.get(sessionManager.ID);

        AlertDialog.Builder alertBuilder = new AlertDialog.Builder(context);

        alertBuilder
                .setTitle("알림")
                .setMessage("로그아웃 되었습니다!")
                .setCancelable(true)
                .setPositiveButton("확인", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        sessionManager.logout(); // 로그아웃

                    }
                });
        AlertDialog dialog = alertBuilder.create();
        dialog.show();

    }
}
