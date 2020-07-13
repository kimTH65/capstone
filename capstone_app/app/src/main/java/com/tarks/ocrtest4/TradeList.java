package com.tarks.ocrtest4;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

public class TradeList extends AppCompatActivity {


    Toolbar toolbar;
    ActionBar actionBar;


    private static String TAG = "phptest_Tradelist";

    private static final String TAG_JSON="webnautes";
    private static final String TAG_JSON2="webnautes2";
    private static final String TAG_NICK = "user_nick";
    private static final String TAG_NAME = "opponent";
    private static final String TAG_JOB = "user_job";

    ListView mlistView;
    TradeViewAdapter adapter;

    String chackCard2 = "";

    private List<TradeViewItem> userlist;

    String mJsonString;
    String data = "";

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tradelist);

        toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        actionBar = getSupportActionBar();
        actionBar.setDisplayShowCustomEnabled(true);
        actionBar.setDisplayShowTitleEnabled(false);//기본 제목을 없애줍니다.
        actionBar.setDisplayHomeAsUpEnabled(true);//뒤로가기 버튼

        userlist = new ArrayList<TradeViewItem>();

        // Adapter 생성
        adapter = new TradeViewAdapter(getApplicationContext(), userlist);

        mlistView = (ListView)findViewById(R.id.listView_trade_list);

        GetData task = new GetData();
        task.execute();

        mlistView.setAdapter(adapter);



        //아이템 클릭시 토스트 메시지 출력
        mlistView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                int count, checked ;
                count = adapter.getCount() ;

                if (count > 0) {
                    // 현재 선택된 아이템의 position 획득.
                    checked = mlistView.getCheckedItemPosition();

                    chackCard2 = userlist.get(checked).getName();

                    Intent intent = new Intent(getApplicationContext(), tradelist_view.class);

                    intent.putExtra("userid",chackCard2); /*송신*/
                    startActivity(intent);


                    //Toast.makeText(getApplicationContext(), "이름 : " + chackCard2, Toast.LENGTH_SHORT).show();
                }
            }


        });
    }

    private  class GetData extends AsyncTask<String, Void, String> {

        ProgressDialog asyncDialog = new ProgressDialog(TradeList.this);

        String errorString = null;

        protected void onPreExecute(){
            asyncDialog.setProgressStyle(ProgressDialog.STYLE_HORIZONTAL);
            asyncDialog.setMessage("로딩중입니다..");

            //다이얼로그 표출
            asyncDialog.show();
            super.onPreExecute();
        }

        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);
            asyncDialog.dismiss();

            Log.d(TAG, "response  - " + result);

            if (result == null){

            }
            else {

                mJsonString = result;
                showResult();
            }
        }

        @Override
        protected String doInBackground(String... params) {

            /* 인풋 파라메터값 생성 */
            String param = "u_id=" + LoginActivate.user_id + "";
            Log.e("POST", param);

            try {

                for(int i=0; i<5; i++)
                {
                    asyncDialog.setProgress(i*30);
                    Thread.sleep(500);
                }
                /* 서버연결 */
                URL url = new URL("http://52.205.255.37/move/TradeList.php");
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoInput(true);
                httpURLConnection.connect();

                /* 안드로이드 -> 서버 파라메터값 전달 */
                OutputStream outs = httpURLConnection.getOutputStream();
                outs.write(param.getBytes("UTF-8"));
                outs.flush();
                outs.close();

                /* 서버 -> 안드로이드 파라메터값 전달 */
                InputStream inputStream = null;

                int responseStatusCode = httpURLConnection.getResponseCode();
                Log.d(TAG, "response code - " + responseStatusCode);

                if(responseStatusCode == HttpURLConnection.HTTP_OK) {
                    inputStream = httpURLConnection.getInputStream();
                }
                else{
                    inputStream = httpURLConnection.getErrorStream();
                }

                InputStreamReader inputStreamReader = new InputStreamReader(inputStream, "UTF-8");

                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream), 8 * 1024);

                String line = null;
                StringBuilder sb = new StringBuilder();

                StringBuffer buff = new StringBuffer();
                while ((line = bufferedReader.readLine()) != null) {
                    buff.append(line + "\n");
                }
                data = buff.toString().trim();


                /* 서버에서 응답 */

                Log.e("RECV DATA", data);

                while((line = bufferedReader.readLine()) != null){
                    sb.append(line);
                }

                bufferedReader.close();


                return sb.toString().trim();

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();

                Log.d(TAG, "InsertData: Error ", e);
                errorString = e.toString();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }

            return null;
        }

    }

    private void showResult() {
        try {
            JSONObject jsonObject = new JSONObject(data);
            JSONArray jsonArray = jsonObject.getJSONArray(TAG_JSON);

            //id 값 집어넣을 배열 선언
            String[] id = new String[jsonArray.length()/2];

            //제이슨 값으로 받아온 전체중 절반이 아이디 값이므로 절반 반복
            for(int j = 0; j<jsonArray.length()/2; j++) {
                JSONObject item = jsonArray.getJSONObject(j);
                id[j] = item.getString(TAG_NAME);
            }


            for ( int i = jsonArray.length()/2; i < jsonArray.length(); i++) {

                JSONObject item = jsonArray.getJSONObject(i);

                String nickname = item.getString(TAG_NICK);
              String job = item.getString(TAG_JOB);

                System.out.println("아이디!!!!!!!!!!!!" + id[i - jsonArray.length()/2]);
               System.out.println("닉넴!!!!!!!!!!!!" + nickname);


                TradeViewItem item3 = new TradeViewItem(id[i - jsonArray.length()/2], nickname, job);
                userlist.add(item3);

                adapter.notifyDataSetChanged();

            }


        } catch (JSONException e) {

            Log.d(TAG, "showResult : ", e);
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
                Intent intent = new Intent(TradeList.this, website.class);
                startActivity(intent);

                return true;
            }
            case R.id.set2: {
                Intent intent = new Intent(TradeList.this, Member.class);
                startActivity(intent);

                return true;
            }
            case R.id.set3: {
                Intent intent = new Intent(TradeList.this, Logout.class);
                startActivity(intent);

                return true;
            }


            case android.R.id.home:
            {

                Intent intent = new Intent(TradeList.this, First.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);

            }


            default:
                return false;
        }
    }
}
