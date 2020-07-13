package com.tarks.ocrtest4;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.core.content.FileProvider;
import androidx.fragment.app.Fragment;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.ComponentName;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.content.pm.ResolveInfo;
import android.content.res.AssetManager;
import android.content.res.Configuration;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Matrix;
import android.media.ExifInterface;
import android.media.MediaScannerConnection;
import android.media.ThumbnailUtils;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Environment;
import android.os.Message;
import android.provider.MediaStore;
import android.provider.Settings;
import android.util.Base64;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.googlecode.tesseract.android.TessBaseAPI;

import java.io.ByteArrayOutputStream;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Random;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {


    Toolbar toolbar;
    ActionBar actionBar;

    SessionManager sessionManager; // 전역에서 사용하기 위해 세션 선언

    TessBaseAPI tess;
    String datapath = "";
    String full = ""; //문자 인식한 전체 글

    static Context mContext;
    static ProgressDialog pd;
    static String temp="";

    public static String name = "";  //이름
    public static String phon = ""; //폰번
    public static String tel = ""; //전번
    public static String email = ""; //이메일
    public static String manager = ""; //직책

    public boolean cutimage = true;

    public static Bitmap image;

    final String TAG = getClass().getSimpleName();
    ImageView imageView;
    Button cameraBtn, btnAlbum;
    final static int TAKE_PICTURE = 1;

    Context context;

    String mCurrentPhotoPath;
    static final int REQUEST_TAKE_PHOTO = 1;        //카메라 촬영
    private static final int PICK_FROM_ALBUM = 2; //앨범에서 사진 가져오기
    private static final int CROP_FROM_CAMERA = 3; //가져온 사진을 자르기 위한 변수
    private static final int MY_PERMISSION_CAMERA = 11111;

    public static Uri photoUri, albumUri = null;
    boolean album = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        actionBar = getSupportActionBar();
        actionBar.setDisplayShowCustomEnabled(true);
        actionBar.setDisplayShowTitleEnabled(false);//기본 제목을 없애줍니다.
        actionBar.setDisplayHomeAsUpEnabled(true);//뒤로가기 버튼

      // sessionManager = new SessionManager(this); // 세션 생성
        //sessionManager.checkLogin(); // 로그인 되어있는지 체크함
        //HashMap<String, String> user = sessionManager.getUserDetail(); // user 라는 해시맵을 만들어서 세션값을 관리함
      // String mId = user.get(sessionManager.ID); // mId에 현재 로그인한 사용자 정보를 저장함

        // 레이아웃과 변수 연결
        imageView = findViewById(R.id.imageview);
        cameraBtn = findViewById(R.id.camera_button);
        btnAlbum = findViewById(R.id.btn_album);

        // 카메라 버튼에 리스터 추가
        cameraBtn.setOnClickListener(this);
        btnAlbum.setOnClickListener(this);

        mContext=this;

        /*
        // 6.0 마쉬멜로우 이상일 경우에는 권한 체크 후 권한 요청
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (checkSelfPermission(Manifest.permission.CAMERA) == PackageManager.PERMISSION_GRANTED &&
                    checkSelfPermission(Manifest.permission.WRITE_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED&&
                    checkSelfPermission(Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED) {
                Log.d(TAG, "권한 설정 완료");
            } else {
                Log.d(TAG, "권한 설정 요청");
                ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.CAMERA, Manifest.permission.WRITE_EXTERNAL_STORAGE, Manifest.permission.READ_EXTERNAL_STORAGE}, 1);
            }
        }
        */

        checkPermission();


        //데이터 경로
        datapath = getFilesDir() + "/tesseract/";

        //한글 & 영어 데이터 체크
        checkFile(new File(datapath + "tessdata/"), "kor");
        checkFile(new File(datapath + "tessdata/"), "eng");


        //문자 인식을 수행할 tess 객체 생성
        String lang = "kor+eng";
        tess = new TessBaseAPI();
        tess.init(datapath, lang);

        //문자 인식 진행
        image = BitmapFactory.decodeResource(getResources(), R.drawable.test);


    }


    //권한요청

    private void checkPermission() {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.WRITE_EXTERNAL_STORAGE) != PackageManager.PERMISSION_GRANTED) {
            // 처음 호출시엔 if()안의 부분은 false로 리턴 됨 -> else{..}의 요청으로 넘어감
            if ((ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.WRITE_EXTERNAL_STORAGE)) ||
                    (ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.CAMERA))) {
                new AlertDialog.Builder(MainActivity.this)
                        .setTitle("알림")
                        .setMessage("저장소 권한이 거부되었습니다. 사용을 원하시면 설정에서 해당 권한을 직접 허용하셔야 합니다.")
                        .setNeutralButton("설정", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                Intent intent = new Intent(Settings.ACTION_APPLICATION_DETAILS_SETTINGS);
                                intent.setData(Uri.parse("package:" + getPackageName()));
                                startActivity(intent);
                            }
                        })
                        .setPositiveButton("확인", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                finish();
                            }
                        })
                        .setCancelable(false)
                        .create()
                        .show();
            } else {
                ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE, Manifest.permission.CAMERA}, MY_PERMISSION_CAMERA);
            }
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        switch (requestCode) {
            case MY_PERMISSION_CAMERA:
                for (int i = 0; i < grantResults.length; i++) {
                    // grantResults[] : 허용된 권한은 0, 거부한 권한은 -1
                    if (grantResults[i] < 0) {
                        Toast.makeText(MainActivity.this, "해당 권한을 활성화 하셔야 합니다.", Toast.LENGTH_SHORT).show();
                        return;
                    }
                }
                // 허용했다면 이 부분에서..

                break;
        }
    }



   /* // 권한 요청
    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        Log.d(TAG, "onRequestPermissionsResult");
        if (grantResults[0] == PackageManager.PERMISSION_GRANTED && grantResults[1] == PackageManager.PERMISSION_GRANTED ) {
            Log.d(TAG, "Permission: " + permissions[0] + "was " + grantResults[0]);
        }
    } */

    //카메라 인텐트 실행
    private void dispatchTakePictureIntent() {
        Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        // Ensure that there's a camera activity to handle the intent
        if (takePictureIntent.resolveActivity(getPackageManager()) != null) {
            // Create the File where the photo should go
            File photoFile = null;
            try {
                photoFile = createImageFile();
            } catch (IOException ex) {
                // Error occurred while creating the File
            }
            // Continue only if the File was successfully created
            if (photoFile != null) {
                photoUri = FileProvider.getUriForFile(this,
                        "com.tarks.ocrtest4.fileprovider",
                        photoFile);
                takePictureIntent.putExtra(MediaStore.EXTRA_OUTPUT, photoUri);
                startActivityForResult(takePictureIntent, REQUEST_TAKE_PHOTO);

                //uploadFilePath = photoUri.getPath();

            }
        }
        name = "";
        phon = "";
        tel = "";
        email = "";
        manager = "";
    }

    private void goToAlbum() {      //앨범열기
        Intent intent = new Intent(Intent.ACTION_PICK);
        intent.setType(MediaStore.Images.Media.CONTENT_TYPE);
        startActivityForResult(intent, PICK_FROM_ALBUM);
        name = "";
        phon = "";
        tel = "";
        email = "";
        manager = "";
    }


    // 버튼 onClick리스터 처리부분
    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.camera_button:
                // 카메라 앱을 여는 소스
                dispatchTakePictureIntent();
                break;
            case R.id.btn_album:
                goToAlbum();
                break;

        }
    }

    public void nextView(View v) {

        Intent intent = new Intent(this, AddressAct.class);
        startActivity(intent);

        MoveFile.registDB rdb = new MoveFile.registDB();
        rdb.execute();

    }

    //수동 크롭
    public void croppImage(View v){
        cropImage();
        galleryAddPic();
    }

    //자동 이미지 크롭 버튼
    public void cutImage(View v){

        if(cutimage) {
            mThread.start();
            cutimage = false;

            try {
                mThread.join();
                imageView.setImageBitmap(image);

            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }
        else
        {
            Toast.makeText(getApplicationContext(), "자동크롭이 완료되었습니다.", Toast.LENGTH_SHORT).show();
        }


    }

    // 카메라로 촬영한 영상을 가져오는 부분
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        try {
            switch (requestCode) {
                case PICK_FROM_ALBUM:
                    album = true;
                    File albumFile = null;
                    try {
                        albumFile = createImageFile();
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                    if (albumFile != null) {
                        albumUri = Uri.fromFile(albumFile);
                        //앨범이미지 크롭한 결과
                    }
                    photoUri = data.getData();
                    cropImage();
                    galleryAddPic();
                    // uploadFile(mCurrentPhotoPath);
                    break;


                case REQUEST_TAKE_PHOTO:
                    album = false;
                    File albumFile2 = null;
                    try {
                        albumFile2 = createImageFile();
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                    if (albumFile2 != null) {
                        albumUri = Uri.fromFile(albumFile2);
                        //앨범이미지 크롭한 결과
                    }


                    if (resultCode == RESULT_OK) {
                        File file = new File(mCurrentPhotoPath);
                        Bitmap bitmap = MediaStore.Images.Media
                                .getBitmap(getContentResolver(), Uri.fromFile(file));

                        image = bitmap;

                        if (bitmap != null) {
                            ExifInterface ei = new ExifInterface(mCurrentPhotoPath);
                            int orientation = ei.getAttributeInt(ExifInterface.TAG_ORIENTATION,
                                    ExifInterface.ORIENTATION_UNDEFINED);

                            Bitmap rotatedBitmap = null;
                            switch (orientation) {

                                case ExifInterface.ORIENTATION_ROTATE_90:
                                    rotatedBitmap = rotateImage(bitmap, 90);
                                    break;

                                case ExifInterface.ORIENTATION_ROTATE_180:
                                    rotatedBitmap = rotateImage(bitmap, 180);
                                    break;

                                case ExifInterface.ORIENTATION_ROTATE_270:
                                    rotatedBitmap = rotateImage(bitmap, 270);
                                    break;

                                case ExifInterface.ORIENTATION_NORMAL:
                                default:
                                    rotatedBitmap = bitmap;
                            }


                            image = rotatedBitmap;
                            imageView.setImageBitmap(rotatedBitmap);

                        }
                    }

                    cropImage();
                    galleryAddPic();
                    //uploadFile(mCurrentPhotoPath);

                    break;

                case CROP_FROM_CAMERA:

                    Bitmap photo = BitmapFactory.decodeFile(albumUri.getPath());
                    imageView.setImageBitmap(photo);
                    image = photo;

                    galleryAddPic();

                    uploadFile(mCurrentPhotoPath);

                    break;


            }


        } catch (Exception error) {
            error.printStackTrace();

        }


    }



    private void cropImage() {

        Intent intent = new Intent("com.android.camera.action.CROP");
        intent.setDataAndType(photoUri, "image/*");

        intent.putExtra("outputX", 1450);
        intent.putExtra("outputY", 950);
        intent.putExtra("aspectX", true);
        intent.putExtra("aspectY", true);
        intent.putExtra("scale", true);
        intent.putExtra("output", albumUri);//크롭된 이미지를 해당경로에 저장

        intent.addFlags(Intent.FLAG_GRANT_READ_URI_PERMISSION);
        intent.addFlags(Intent.FLAG_GRANT_WRITE_URI_PERMISSION);


        startActivityForResult(intent, CROP_FROM_CAMERA);

        // uploadFile(mCurrentPhotoPath);


    }

    //갤러리 새로고침
    private void galleryAddPic() {
        Intent mediaScanIntent = new Intent(Intent.ACTION_MEDIA_SCANNER_SCAN_FILE);
        File f = new File(mCurrentPhotoPath);
        Uri contentUri = Uri.fromFile(f);
        mediaScanIntent.setData(contentUri);
        this.sendBroadcast(mediaScanIntent);
    }


    //촬영한 이미지 파일로 저장
    private File createImageFile() throws IOException {
        // Create an image file name
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        String imageFileName = timeStamp + ".jpg";
        // File storageDir = new File(Environment.getExternalStorageDirectory().getAbsolutePath() + "/pathvalue/"+imageFileName);
        File storageDir = getExternalFilesDir(Environment.DIRECTORY_PICTURES);

        File image = File.createTempFile(
                imageFileName,  /* prefix */
                ".jpg",         /* suffix */
                storageDir      /* directory */
        );


        //mCurrentPhotoPath = storageDir.getAbsolutePath();
        //Log.i("mCurrentPhotoPath------- : ", mCurrentPhotoPath);

        //return storageDir;


        // Save a file: path for use with ACTION_VIEW intents
        mCurrentPhotoPath = image.getAbsolutePath();

        return image;
    }

    public static Bitmap rotateImage(Bitmap source, float angle) {
        Matrix matrix = new Matrix();
        matrix.postRotate(angle);
        return Bitmap.createBitmap(source, 0, 0, source.getWidth(), source.getHeight(),
                matrix, true);
    }


    //문자 인식 및 결과 출력
    public void processImage(View view) {
        Toast.makeText(getApplicationContext(), "이미지가 복잡할 경우 많은 시간 소요", Toast.LENGTH_LONG).show();
        String OCRresult = null;
        tess.setImage(image);
        OCRresult = tess.getUTF8Text();
        TextView OCRTextView = (TextView) findViewById(R.id.tv_result);


        full = OCRresult;
        String[] cut_target = full.split("\\n");
        for (int i = 0; i < cut_target.length; i++) {
            System.out.println("총" + i + "줄");
            cut_target[i] = cut_target[i].replaceAll(" ", "");    //문자열 사이 공백제거
            cut_target[i] = cut_target[i].trim();   //문자열 젤앞 공백제거

            if (cut_target[i].matches(".*사장.*"))
                manager = "사장";
            if (cut_target[i].matches(".*부사장.*"))
                manager = "부사장";
            if (cut_target[i].matches(".*전무.*"))
                manager = "전무";
            if (cut_target[i].matches(".*상무.*"))
                manager = "상무";
            if (cut_target[i].matches(".*이사.*"))
                manager = "이사";
            if (cut_target[i].matches(".*부장.*"))
                manager = "부장";
            if (cut_target[i].matches(".*본부장.*"))
                manager = "본부장";
            if (cut_target[i].matches(".*본부쟝.*"))
                manager = "본부장";
            if (cut_target[i].matches(".*본부.*"))
                manager = "본부장";
            if (cut_target[i].matches(".*차장.*"))
                manager = "차장";
            if (cut_target[i].matches(".*과장.*"))
                manager = "과장";
            if (cut_target[i].matches(".*대리.*"))
                manager = "대리";
            if (cut_target[i].matches(".*주임.*"))
                manager = "주임";
            if (cut_target[i].matches(".*사원.*"))
                manager = "사원";
            if (cut_target[i].matches(".*팀장.*"))
                manager = "팀장";
            if (cut_target[i].matches(".*매니저.*"))
                manager = "매니저";
            if (cut_target[i].matches(".*매니져.*"))
                manager = "매니져";
            if (cut_target[i].matches(".*공장.*"))
                manager = "공장";
            if (cut_target[i].matches(".*직장.*"))
                manager = "직장";
            if (cut_target[i].matches(".*반장.*"))
                manager = "반장";
            if (cut_target[i].matches(".*조장.*"))
                manager = "조장";
            if (cut_target[i].matches(".*회장.*"))
                manager = "회장";
            if (cut_target[i].matches(".*실장.*"))
                manager = "실장";
            if (cut_target[i].matches(".*실쟝.*"))
                manager = "실쟝";
            if (cut_target[i].matches(".*ceo.*"))
                manager = "ceo";
            if (cut_target[i].matches(".*CEO.*"))
                manager = "CEO";
            if (cut_target[i].matches(".*지점장.*"))
                manager = "지점장";
            if (cut_target[i].matches(".*부지점장.*"))
                manager = "부지점장";

            //직책(더생기면 더추가)


            if ((i == 0 || i == 1 || i == 2 || i == 3 || i == 4) && (cut_target[i].length() <= 7)
                    && (cut_target[i].length() >= 2))    //1,2,3,4번째줄이며 띄우기 포함 6글자미만은 이름으로 넣기
            {

                System.out.println("이름 : " + cut_target[i]);
                name = cut_target[i].replace(manager, "");      //이름앞에 직첵 제거
            }

            if (cut_target[i].matches(".*010.*")) {
                cut_target[i] = cut_target[i].replace("phone", "");
                System.out.println("휴대폰 번호 : " + cut_target[i]);
                if(cut_target[i].length()<=13)
                    phon = cut_target[i].substring(0, 13);       //처음부터 14번째 글자까지만 추출
                else if(cut_target[i].length()<=14)
                    phon = cut_target[i].substring(0, 14);
                else if(cut_target[i].length()<=15)
                    phon = cut_target[i].substring(0, 15);
                else if(cut_target[i].length()<=16)
                    phon = cut_target[i].substring(0, 16);
                else
                    phon = cut_target[i].substring(0, 15);

            } else if ((cut_target[i].matches(".*02.*") || cut_target[i].matches(".*051.*") || cut_target[i].matches(".*053.*")
                    || cut_target[i].matches(".*032.*") || cut_target[i].matches(".*062.*") || cut_target[i].matches(".*042.*")
                    || cut_target[i].matches(".*052.*") || cut_target[i].matches(".*044.*") || cut_target[i].matches(".*031.*")
                    || cut_target[i].matches(".*033.*") || cut_target[i].matches(".*043.*") || cut_target[i].matches(".*041.*")
                    || cut_target[i].matches(".*063.*") || cut_target[i].matches(".*061.*") || cut_target[i].matches(".*054.*")
                    || cut_target[i].matches(".*055.*") || cut_target[i].matches(".*064.*"))) {
                System.out.println("전화번호 : " + cut_target[i]);
                tel = cut_target[i];
            }

            if (cut_target[i].matches(".*@.*") || cut_target[i].matches(".*com.*") || cut_target[i].matches(".*net.*")
                    || cut_target[i].matches(".*©.*")) {
                System.out.println("이메일 : " + cut_target[i]);
                email = cut_target[i].replace(phon, ""); //이메일에 붙은 폰 제거
            }


        }

        OCRTextView.setText("이름: " + name + "\n"
                            +"직책: " + manager + "\n"
                            +"폰 번호: " + phon + "\n"
                            +"전화번호" + tel + "\n"
                            +"이메일: " + email + "\n");
    }

    //파일 복제
    private void copyFiles(String lang) {
        try {
            String filepath = datapath + "/tessdata/" + lang + ".traineddata";

            AssetManager assetManager = getAssets();

            InputStream inStream = assetManager.open("tessdata/" + lang + ".traineddata");
            OutputStream outStream = new FileOutputStream(filepath);

            byte[] buffer = new byte[1024];
            int read;
            while ((read = inStream.read(buffer)) != -1) {
                outStream.write(buffer, 0, read);
            }
            outStream.flush();
            outStream.close();
            inStream.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }


    //파일 존재 확인
    private void checkFile(File dir, String lang) {
        if (!dir.exists() && dir.mkdirs()) {
            copyFiles(lang);
        }

        if (dir.exists()) {
            String datafilePath = datapath + "/tessdata/" + lang + ".traineddata";
            File datafile = new File(datafilePath);
            if (!datafile.exists()) {
                copyFiles(lang);
            }
        }
    }


    //파일 php 서버에 업로드
    //URL수정시 JoinActivate, LoginActivate, AddressAct, savelist(2개), movefile -> registDB 쪽 URL도 수정할것

    public void uploadFile(String filePath) {
        String url = "http://52.205.255.37/move/UploadToServer.php";
        try {
            UploadFile uploadFile = new UploadFile(MainActivity.this);
            uploadFile.setPath(filePath);
            uploadFile.execute(url);
        } catch (Exception e) {

        }
    }


    Thread mThread = new Thread() {
        @Override
        public void run() {
            try {
                URL url = new URL("http://52.205.255.37/move/scannedImage2.png");

                //Web에서 이미지를 가져온 뒤
                //이미지뷰에 지정할 비트맵을 만든다
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setDoInput(true); //서버러부터 응답 수신
                conn.connect();

                InputStream is = conn.getInputStream(); //inputstream 값 가져오기
                image = BitmapFactory.decodeStream(is); //비트맵으로 변환

                conn.disconnect();
                is.close();
            }

            catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    };

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_set, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item){

        switch (item.getItemId()){

            case R.id.set1: {
                Intent intent = new Intent(MainActivity.this, website.class);
                startActivity(intent);

                return true;
            }
            case R.id.set2: {
                Intent intent = new Intent(MainActivity.this, Member.class);
                startActivity(intent);

                return true;
            }
            case R.id.set3: {
                Intent intent = new Intent(MainActivity.this, Logout.class);
                startActivity(intent);

                return true;
            }


            case android.R.id.home:
            {

                Intent intent = new Intent(MainActivity.this, First.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);

            }


            default:
                return false;
        }
    }


}
