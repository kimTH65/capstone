package com.tarks.ocrtest4;

import android.app.ProgressDialog;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.media.Image;
import android.os.AsyncTask;
import android.os.Bundle;

import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;

import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

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
import java.util.HashMap;
import java.util.List;

import static androidx.constraintlayout.widget.Constraints.TAG;


public class Savelist extends Fragment {

    public static Context context;
    private static String TAG = "phptest_Savelist";

    private static final String TAG_JSON="webnautes";
    private static final String TAG_IMAGE = "card_image";
    private static final String TAG_NAME = "card_name";
    private static final String TAG_PHON ="card_phon";

    ListView mlistView;
    ListViewAdapter adapter;

    private List<ListViewItem> userlist;

    String mJsonString;
    String data = "";
    String chackCard = "";      //리스트뷰에서 선택된 아이템 이름
    String chackCard2 = "";

    int imagechange = 0;   //이미지 반복문 돌릴용


    ViewGroup viewGroup;


    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);


    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        viewGroup = (ViewGroup) inflater.inflate(R.layout.activity_savelist, container, false);

        context = container.getContext();

        userlist = new ArrayList<ListViewItem>();

        // Adapter 생성
        adapter = new ListViewAdapter(getActivity().getApplication(), userlist);

        mlistView = (ListView)viewGroup.findViewById(R.id.listView_main_list);

        GetData task = new GetData();
        task.execute();

        mlistView.setAdapter(adapter);

        Button deleteButton = (Button)viewGroup.findViewById(R.id.delete) ;
        deleteButton.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                int count, checked ;
                count = adapter.getCount() ;

                if (count > 0) {
                    // 현재 선택된 아이템의 position 획득.
                    checked = mlistView.getCheckedItemPosition();

                    if (checked > -1 && checked < count) {

                        chackCard = userlist.get(checked).getCard_name();

                        deletCard task2 = new deletCard();
                        task2.execute();

                        // 아이템 삭제
                        userlist.remove(checked) ;

                        // listview 선택 초기화.
                        mlistView.clearChoices();

                        // listview 갱신.
                        adapter.notifyDataSetChanged();

                    }
                }
            }
        }) ;

        mlistView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                int count, checked ;
                count = adapter.getCount() ;

                if (count > 0) {
                    // 현재 선택된 아이템의 position 획득.
                    checked = mlistView.getCheckedItemPosition();

                    chackCard2 = userlist.get(checked).getCard_name();

                    Toast.makeText(context, "이름 : " + chackCard2, Toast.LENGTH_SHORT).show();
                }
            }


        });

        return viewGroup;

    }


    private  class GetData extends AsyncTask<String, Void, String> {

        ProgressDialog asyncDialog = new ProgressDialog(getActivity());

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
                URL url = new URL("http://52.205.255.37/move/list.php");
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

            for ( imagechange = 0; imagechange < jsonArray.length(); imagechange++) {

                JSONObject item = jsonArray.getJSONObject(imagechange);

                String image = item.getString(TAG_IMAGE);
                String name = item.getString(TAG_NAME);
                String phon = item.getString(TAG_PHON);

                String urll = "http://52.205.255.37/move/uploads//";

                //이미지 명
                urll = urll+image;

                System.out.println("!!!!!!!!!!!!!!!!!!!!!!!!!!!"+urll);

                ListViewItem item3 = new ListViewItem(urll, name, phon);
                userlist.add(item3);

                adapter.notifyDataSetChanged();

            }

        } catch (JSONException e) {

            Log.d(TAG, "showResult : ", e);
        }


    }


    //삭제버튼

    private  class deletCard extends AsyncTask<String, Void, String> {

        ProgressDialog asyncDialog = new ProgressDialog(getActivity());

        String errorString = null;

        protected void onPreExecute() {
            asyncDialog.setProgressStyle(ProgressDialog.STYLE_HORIZONTAL);
            asyncDialog.setMessage("삭제중..");

            //다이얼로그 표출
            asyncDialog.show();
            super.onPreExecute();
        }

        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);
            asyncDialog.dismiss();

            Log.d(TAG, "response  - " + result);

        }

        @Override
        protected String doInBackground(String... params) {

            /* 인풋 파라메터값 생성 */

            String param = "u_id=" + chackCard + "";
            Log.e("POST", param);

            try {
                /* 서버연결 */
                URL url = new URL("http://52.205.255.37/move/deletcard.php");
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

                while ((line = in.readLine()) != null) {
                    buff.append(line + "\n");
                }
                data = buff.toString().trim();


                Log.e("RECV DATA", data);

                if(data.equals("1")) {
                    Log.e("RESULT", "성공적으로 처리되었습니다!");
                }
                else if(data.equals("0"))
                {
                    Log.e("RESULT", "실패!");
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