package com.tarks.ocrtest4;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class UploadFile extends AsyncTask<String, String, String> {

    Context context; //생성자 호출 시
    ProgressDialog mProgressDialog; //진행 상태 다이얼로그
    static String fileName; //파일 위치

    HttpURLConnection conn = null; //네트워크 연결 객체
    DataOutputStream dos = null; //서버 전송시 데이터 작성한 뒤 전송

    String lineEnd = "\r\n";
    String twoHyphens = "--";
    String boundary = "*****";

    int bytesRead, bytesAvailable, bufferSize;
    byte[] buffer;
    int maxBufferSize = 4024;
    File sourceFile;
    int serverResponseCode;
    String TAG = "FileUpload";

    public UploadFile(MainActivity context){
        this.context = context;
    }

    public void setPath(String uploadFilePath){
        this.fileName = uploadFilePath;
        this.sourceFile = new File(uploadFilePath);
    }

    @Override
    protected void onPreExecute(){
        super.onPreExecute();
        mProgressDialog = new ProgressDialog(context);
        mProgressDialog.setProgressStyle(ProgressDialog.STYLE_HORIZONTAL);
        mProgressDialog.setTitle("로딩중...");
        mProgressDialog.setMessage("이미지 업로드중...");
        mProgressDialog.setCanceledOnTouchOutside(false);
        mProgressDialog.setIndeterminate(false);
        mProgressDialog.show();
    }

    @Override
    protected void onPostExecute(String result) {
        super.onPostExecute(result);
        mProgressDialog.dismiss();
    }





    @Override
    protected String doInBackground(String... strings){


        if(!sourceFile.isFile()){//해당 위치의 파일이 있는지 검사
            Log.e(TAG, "sourceFile("+fileName+") is Not A File");
        return null;
    }else{
            String success = "Success";
            Log.i(TAG,"sourceFile("+fileName+") is A File");

            try {

                for(int i=0; i<5; i++)
                {
                    mProgressDialog.setProgress(i*30);
                    Thread.sleep(500);
                }

                FileInputStream fileInputStream = new FileInputStream(sourceFile);
                URL url = new URL(strings[0]);
                Log.i("strings[0]", strings[0]);

                //open a http connection to the url
                conn = (HttpURLConnection) url.openConnection();
                conn.setDoInput(true);  //allow inputs
                conn.setDoOutput(true);
                conn.setUseCaches(false); //don't use a cached copy
                conn.setRequestMethod("POST"); //전송 방식
                conn.setRequestProperty("Connection", "Keep-Alive");
                conn.setRequestProperty("Content-Type", "multipart/form-data; boundary=" + boundary);
                conn.setRequestProperty("uploaded_file", fileName);
                Log.i(TAG, "fileName: " + fileName);

                dos = new DataOutputStream(conn.getOutputStream());

                //사용자 이름으로 폴더를 생성하기 위해 사용자 이름을 서버로 전송함. 하나의 인자 전달 datal = newImage
                dos.writeBytes(twoHyphens + boundary + lineEnd);
                dos.writeBytes("Content-Disposition: form-data; name=\"datal\"" + lineEnd);
                dos.writeBytes(lineEnd);
                dos.writeBytes("newImage"); //image라는 값을 넘김
                dos.writeBytes(lineEnd);

                //이미지 전송, 데이터 전달 uploadded_file라는 php key 값에 저장되는 내용은 fileName
                dos.writeBytes(twoHyphens + boundary + lineEnd);
                dos.writeBytes("Content-Disposition: form-data; name=\"uploaded_file\"; filename=\"" + fileName + "\"" + lineEnd);
                dos.writeBytes(lineEnd);

                bytesAvailable = fileInputStream.available();

                bufferSize = Math.min(bytesAvailable, maxBufferSize);
                buffer = new byte[bufferSize];

                //read file and write it into form...
                bytesRead = fileInputStream.read(buffer, 0, bufferSize);

                while(bytesRead > 0){
                    dos.write(buffer, 0, bufferSize);
                    bytesAvailable = fileInputStream.available();
                    bufferSize = Math.min(bytesAvailable, maxBufferSize);
                    bytesRead = fileInputStream.read(buffer, 0, bufferSize);
                }

                //send multipart form data necessary after file data..,
                //마지막에 two-- lineEnd로 마무리(인자 나열이 끝났음을 알림)
                dos.writeBytes(lineEnd);
                dos.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);

                //responses from the server (code and message)
                serverResponseCode = conn.getResponseCode();
                String serverResponseMessage = conn.getResponseMessage();

                Log.i(TAG, "[UploadImageToServer] HTTP Response is: " + serverResponseMessage + ": " + serverResponseCode);

                if(serverResponseCode == 200){

                }

                //결과 확인
                BufferedReader rd = null;

                rd = new BufferedReader(new InputStreamReader(conn.getInputStream(), "UTF-8"));
                String line = null;
                while((line = rd.readLine()) != null){
                    Log.i("Upload State", line);
                }

                //close the streams//
                fileInputStream.close();
                dos.flush();
                dos.close();

            }catch(Exception e) {
                Log.e(TAG + " Error", e.toString());
            }
            return success;

            }
        }
}
