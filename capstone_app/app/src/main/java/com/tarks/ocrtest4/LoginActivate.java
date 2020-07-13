package com.tarks.ocrtest4;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.HashMap;

public class LoginActivate extends AppCompatActivity {

    final Context context = this;
    EditText et_id, et_pw;
    String sId, sPw;
    public static  String user_id;
    SessionManager sessionManager; // 전역에서 사용하기 위해서 세션매니저 생성

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        sessionManager = new SessionManager(this); // 세션 시작

        et_id = (EditText) findViewById(R.id.editText_id);
        et_pw = (EditText) findViewById(R.id.editText_pw);
    }

    public void bt_Join(View view) {
        Intent intent = new Intent(this, JoinActivate.class);
        startActivity(intent);
    }

    public void bt_Login(View v)
    {
        try{
            sId = et_id.getText().toString();
            sPw = et_pw.getText().toString();
        }catch (NullPointerException e)
        {
            Log.e("err",e.getMessage());
        }

        loginDB lDB = new loginDB();
        lDB.execute();


    }

    public class loginDB extends AsyncTask<Void, Integer, Void> {

        String data = "";

        @Override
        protected Void doInBackground(Void... unused) {

            /* 인풋 파라메터값 생성 */
            String param = "u_id=" + sId + "&u_pw=" + sPw + "";
            Log.e("POST", param);
            try {
                /* 서버연결 */
                URL url = new URL(
                        "http://52.205.255.37/move/login.php");
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


                is = conn.getInputStream();
                in = new BufferedReader(new InputStreamReader(is), 8 * 1024);
                String line = null;
                StringBuffer buff = new StringBuffer();
                while ((line = in.readLine()) != null) {
                    buff.append(line + "\n");
                }
                data = buff.toString().trim();


                /* 서버에서 응답 */

                Log.e("RECV DATA", data);


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);


            AlertDialog.Builder alertBuilder = new AlertDialog.Builder(context);


            if(data.equals("1"))
            {
                Log.e("RESULT","성공적으로 처리되었습니다!");
                alertBuilder
                        .setTitle("알림")
                        .setMessage("로그인 되었습니다!")
                        .setCancelable(true)
                        .setPositiveButton("확인", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                sessionManager.createSession(sId,sPw); // 로그인 후 아이디값을 가지는 세션을 만듦
                                Intent intent = new Intent(LoginActivate.this, First.class);
                                startActivity(intent);
                                finish();
                            }
                        });
                AlertDialog dialog = alertBuilder.create();
                dialog.show();
                user_id = sId;
            }
            else if(data.equals("0"))
            {
                Log.e("RESULT","비밀번호가 일치하지 않습니다.");
                alertBuilder
                        .setTitle("알림")
                        .setMessage("비밀번호가 일치하지 않습니다.")
                        .setCancelable(true)
                        .setPositiveButton("확인", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                //finish();
                            }
                        });
                AlertDialog dialog = alertBuilder.create();
                dialog.show();
            }
            else
            {
                Log.e("RESULT","에러 발생! ERRCODE = " + data);
                alertBuilder
                        .setTitle("알림")
                        .setMessage("등록중 에러가 발생했습니다! errcode : "+ data)
                        .setCancelable(true)
                        .setPositiveButton("확인", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                //finish();
                            }
                        });
                AlertDialog dialog = alertBuilder.create();
                dialog.show();
            }

        }
    }

}
