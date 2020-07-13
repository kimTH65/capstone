package com.tarks.ocrtest4;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;


import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;

import android.os.AsyncTask;
import android.os.Bundle;

import android.provider.Contacts;

import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

import static com.tarks.ocrtest4.MainActivity.image;


public class AddressAct extends AppCompatActivity {

    Toolbar toolbar;
    ActionBar actionBar;

   public static EditText nametxt2, phontxt, teltxt, email, manager;
   String name, phon, tel, em, mana;
   ImageView imageView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_address);

        toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        actionBar = getSupportActionBar();
        actionBar.setDisplayShowCustomEnabled(true);
        actionBar.setDisplayShowTitleEnabled(false);//기본 제목을 없애줍니다.
        actionBar.setDisplayHomeAsUpEnabled(true);//뒤로가기 버튼

        nametxt2 = findViewById(R.id.name2);
        phontxt = findViewById(R.id.phon);
        teltxt = findViewById(R.id.tel);
        email = findViewById(R.id.email);
        manager = findViewById(R.id.menager);
        imageView = findViewById((R.id.imageView));

        nametxt2.setText(MainActivity.name);
        phontxt.setText(MainActivity.phon);
        teltxt.setText(MainActivity.tel);
        email.setText(MainActivity.email);
        manager.setText((MainActivity.manager));
        imageView.setImageBitmap((image));

    }

    public void AddressBut(View v) {

        name = nametxt2.getText().toString();
        phon = phontxt.getText().toString();
        tel = teltxt.getText().toString();
        em = email.getText().toString();
        mana = manager.getText().toString();

        MainActivity.name = nametxt2.getText().toString();
        MainActivity.manager = manager.getText().toString();

            Intent addContactIntent = new Intent(Contacts.Intents.Insert.ACTION, Contacts.People.CONTENT_URI);
            addContactIntent.putExtra(Contacts.Intents.Insert.NAME, MainActivity.name); // 이름
            addContactIntent.putExtra(Contacts.Intents.Insert.EMAIL, email.getText());  //이메일
            addContactIntent.putExtra(Contacts.Intents.Insert.PHONE, phontxt.getText()); //폰번호
            addContactIntent.putExtra(Contacts.Intents.Insert.SECONDARY_PHONE, teltxt.getText()); //전화번호
            addContactIntent.putExtra(Contacts.Intents.Insert.JOB_TITLE, MainActivity.manager);    //직책


            registDB rdb = new registDB();
            rdb.execute();

            startActivity(addContactIntent);

            System.out.println(nametxt2.getText());
        }

    public class registDB extends AsyncTask<Void, Integer, Void> {

        ProgressDialog mProgressDialog; //진행 상태 다이얼로그

        @Override
        protected void onPreExecute(){
            super.onPreExecute();
            mProgressDialog = new ProgressDialog(AddressAct.this);
            mProgressDialog.setTitle("로딩중...");
            mProgressDialog.setMessage("연락처 저장중...");
            mProgressDialog.setCanceledOnTouchOutside(false);
            mProgressDialog.setIndeterminate(false);
            mProgressDialog.show();
        }

        @Override
        protected void onPostExecute(Void result) {
            super.onPostExecute(result);
            mProgressDialog.dismiss();
        }

        @Override
        protected Void doInBackground(Void... unused) {
            /* 인풋 파라메터값 생성 */
            String param = "u_name=" + name + "&u_phon=" + phon + "&u_tel=" + tel + "&u_em=" + em + "&u_mana=" + mana + "&u_id=" + LoginActivate.user_id + "";

            try {

                for(int i=0; i<5; i++)
                {
                    mProgressDialog.setProgress(i*30);
                    Thread.sleep(500);
                }

                /* 서버연결 */
                URL url = new URL(
                        "http://52.205.255.37/move/addImage.php");
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
                    Toast.makeText(getApplicationContext(), "완료", Toast.LENGTH_SHORT).show();
                }
                else
                {
                    Log.e("RESULT","에러 발생! ERRCODE = " + data);
                }

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }

            return null;

        }

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_set, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item){

        switch (item.getItemId()){

            case R.id.set1: {
                Intent intent = new Intent(AddressAct.this, website.class);
                startActivity(intent);

                return true;
            }
            case R.id.set2: {
                Intent intent = new Intent(AddressAct.this, Member.class);
                startActivity(intent);

                return true;
            }
            case R.id.set3: {
                Intent intent = new Intent(AddressAct.this, Logout.class);
                startActivity(intent);

                return true;
            }


            case android.R.id.home:
            {

                Intent intent = new Intent(AddressAct.this, First.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);

            }


            default:
                return false;
        }
    }

}
