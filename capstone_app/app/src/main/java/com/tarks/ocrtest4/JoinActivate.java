package com.tarks.ocrtest4;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class JoinActivate extends AppCompatActivity {

    EditText et_id, et_pw, et_pw_chk, et_nic;
    String sId, sPw, sPw_chk, sNic, sJob;

    RadioGroup rg;
    RadioButton rb;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_joinactivate);

        et_id = (EditText) findViewById(R.id.editText_id);
        et_pw = (EditText) findViewById(R.id.editText_pw);
        et_pw_chk = (EditText) findViewById(R.id.editText_pw2);
        et_nic = findViewById((R.id.editText_nic));
        rg = findViewById(R.id.radioGroup1);

        sId = et_id.getText().toString();
        sPw = et_pw.getText().toString();
        sPw_chk = et_pw_chk.getText().toString();
        sNic = et_nic.getText().toString();



    }

    public void bt_Join(View view) {
        /* 버튼을 눌렀을 때 동작하는 소스 */
        sId = et_id.getText().toString();
        sPw = et_pw.getText().toString();
        sPw_chk = et_pw_chk.getText().toString();
        sNic = et_nic.getText().toString();

        int id = rg.getCheckedRadioButtonId();
        rb = findViewById(id);

        String aa = rb.getText().toString();

        System.out.println("ddddddddddddd ->>>"+rb.getText().toString());

        if(aa.equals("일반"))
        {
            sJob = "normal";
            System.out.println("r ->>>"+rb.getText().toString());
        }
        else if(aa.equals("디자이너"))
        {
            sJob = "designer";
            System.out.println("s ->>>"+rb.getText().toString());
        }


        if (sPw.equals(sPw_chk)) {
            /* 패스워드 확인이 정상적으로 됨 */


            registDB rdb = new registDB();
            rdb.execute();


            Intent intent = new Intent(this, LoginActivate.class);
            startActivity(intent);


        } else {
            /* 패스워드 확인이 불일치 함 */
            Toast.makeText(getApplicationContext(), "패스워드가 다릅니다.", Toast.LENGTH_SHORT).show();

        }
    }

    public class registDB extends AsyncTask<Void, Integer, Void> {

        @Override
        protected Void doInBackground(Void... unused) {
            /* 인풋 파라메터값 생성 */
            String param = "u_id=" + sId + "&u_pw=" + sPw + "&u_nic=" + sNic + "&u_job=" + sJob + "";
            System.out.println("!!!!!!!!!!!!!1 ->>>"+sJob);

            try {
                /* 서버연결 */
                URL url = new URL(
                        "http://52.205.255.37/move/snclib_join.php");
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
                            Toast.makeText(getApplicationContext(), "회원가입 완료", Toast.LENGTH_SHORT).show();
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