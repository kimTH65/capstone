package com.tarks.ocrtest4;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Environment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.GridView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import java.io.BufferedReader;
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;

import static androidx.constraintlayout.widget.Constraints.TAG;

public class Mytemp extends Fragment {
    private static int imagNum = 0;
    ViewGroup viewGroup;
    GridView gridView;
    SingerAdapter singerAdapter;
    static Context context;

    SessionManager sessionManager; // 전역에서 사용하기 위해 세션 선언

    String idid = ""; //사용자 아이디
    String imageurl = "";


    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        viewGroup = (ViewGroup) inflater.inflate(R.layout.activity_mytemp, container, false);

        gridView = (GridView)viewGroup.findViewById(R.id.gridView);

        singerAdapter = new SingerAdapter();
        gridView.setAdapter(singerAdapter);

        sessionManager = new SessionManager(getContext()); // 세션 생성
        sessionManager.checkLogin(); // 로그인 되어있는지 체크함
        HashMap<String, String> user = sessionManager.getUserDetail(); // user 라는 해시맵을 만들어서 세션값을 관리함
        String mId = user.get(sessionManager.ID); // mId에 현재 로그인한 사용자 정보를 저장함

        idid = mId;

        GetData task = new GetData();
        task.execute();


        return viewGroup;
    }

    class SingerAdapter extends BaseAdapter {
        ArrayList<SingerItem> items = new ArrayList<SingerItem>();
        @Override
        public int getCount() {
            return items.size();
        }

        public void addItem(SingerItem singerItem){
            items.add(singerItem);
        }

        @Override
        public SingerItem getItem(int i) {
            return items.get(i);
        }

        @Override
        public long getItemId(int i) {
            return i;
        }

        @Override
        public View getView(int i, View view, ViewGroup viewGroup) {
            SingerViewer singerViewer = new SingerViewer(getContext());
            singerViewer.setItem(items.get(i));
            return singerViewer;
        }
    }




    private  class GetData extends AsyncTask<String, Void, String> {

        ProgressDialog asyncDialog = new ProgressDialog(getActivity());

        String errorString = null;

        protected void onPreExecute() {
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

                showResult();


        }

        @Override
        protected String doInBackground(String... params) {

            /* 인풋 파라메터값 생성 */

            String param = "u_id=" + idid+ "";
            Log.e("POST", param);

            try {
                /* 서버연결 */
                URL url = new URL("http://52.205.255.37/move/mytemp.php");
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

                imagNum = Integer.parseInt(data);

                System.out.println("ㅎㅎㅎㅎㅎㅎㅎㅎㅎ " + imagNum);

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            return null;

        }



        private void showResult() {



                for(int i = 1; i-1 < imagNum; i++)
                {
                    String imageurl = "http://54.175.31.167/UserUploads/" + idid + "/";

                    imageurl += i + ".jpg";

                    singerAdapter.addItem(new SingerItem(imageurl));

                    gridView.setAdapter(singerAdapter);

                    System.out.println("아룡하세요!!!!!!!!   ," + imageurl);

                }
        }

    }


}