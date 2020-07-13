package com.tarks.ocrtest4;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.PopupMenu;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import com.google.android.material.bottomnavigation.BottomNavigationView;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class First extends AppCompatActivity{
    BottomNavigationView bottomNavigationView;

    Context context = this;

    //뒤로가기 종료 시간체크
    private final long FINISH_INTERVAL_TIME = 2000;
    private long   backPressedTime = 0;


    Home fragment0;
    Savelist fragment1;
    Mytemp fragment2;
    MainActivity fragment3;

    Toolbar toolbar;
    ActionBar actionBar;

    String titleText = "Home";

    TextView TtextView;

    @SuppressLint("ResourceType")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_first);

        TtextView = findViewById(R.id.tooltext);


        bottomNavigationView = findViewById(R.id.bottomNavigationView);

        toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        actionBar = getSupportActionBar();
        actionBar.setDisplayShowCustomEnabled(true);
        actionBar.setDisplayShowTitleEnabled(false);//기본 제목을 없애줍니다.
        actionBar.setDisplayHomeAsUpEnabled(true);//뒤로가기 버튼


        //프래그먼트 생성
        fragment0 = new Home();
        fragment1 = new Savelist();
        fragment2 = new Mytemp();
        fragment3 = new MainActivity();

        //제일 처음 띄워줄 뷰를 세팅해줍니다. commit();까지 해줘야 합니다.
        getSupportFragmentManager().beginTransaction().replace(R.id.main_layout, fragment0).commitAllowingStateLoss();


        //bottomnavigationview의 아이콘을 선택 했을때 원하는 프래그먼트가 띄워질 수 있도록 리스너를 추가합니다.
        bottomNavigationView.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {

            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
                switch (menuItem.getItemId()) {
                    //menu_bottom.xml에서 지정해줬던 아이디 값을 받아와서 각 아이디값마다 다른 이벤트를 발생시킵니다.

                    case R.id.tab0: {
                        titleText = "Home";
                        getSupportFragmentManager().beginTransaction()
                                .replace(R.id.main_layout, fragment0).commitAllowingStateLoss();


                        changeText();

                        return true;
                    }

                    case R.id.tab1: {
                        titleText = "SaveList";
                        getSupportFragmentManager().beginTransaction()
                                .replace(R.id.main_layout, fragment1).commitAllowingStateLoss();

                        changeText();


                        return true;
                    }
                    case R.id.tab2: {
                        titleText = "MyTemp";
                        getSupportFragmentManager().beginTransaction()
                                .replace(R.id.main_layout, fragment2).commitAllowingStateLoss();


                        changeText();


                        return true;
                    }

                    case R.id.tab3: {
                        Intent intent = new Intent(First.this, MainActivity.class);
                        startActivity(intent);
                        return true;
                    }

                    case R.id.tab4: {
                       // getSupportFragmentManager().beginTransaction()
                               // .replace(R.id.main_layout, fragment4).commitAllowingStateLoss();

                        View view = findViewById(R.id.tab4);

                            PopupMenu p = new PopupMenu(
                                    First.this, // 현재 화면의 제어권자
                                    view); // anchor : 팝업을 띄울 기준될 위젯

                            p.getMenuInflater().inflate(R.menu.menu_share, p.getMenu());

                            p.setOnMenuItemClickListener((PopupMenu.OnMenuItemClickListener) item -> {

                                switch (item.getItemId()) {

                                    case R.id.share2:
                                    {

                                        Intent intent = new Intent(First.this, Bluetooth.class);
                                        startActivity(intent);

                                        return true;
                                    }
                                    case R.id.share3:
                                    {
                                        Intent intent = new Intent(First.this, Nfc_menu.class);
                                        startActivity(intent);

                                        return true;
                                    }

                                    case R.id.share4:
                                    {
                                        Intent intent = new Intent(First.this, CreateQR.class);
                                        startActivity(intent);


                                        return true;
                                    }
                                    case R.id.share5:
                                    {
                                        Intent intent = new Intent(First.this, TradeList.class);
                                        startActivity(intent);

                                        return true;
                                    }



                                    default:
                                        return false;
                                }
                            });

                            p.show(); // 메뉴를 띄우기


                        return true;
                    }

                    default:
                        return false;

                }
            }
        });



    }


    public void changeText()
    {
        TtextView.setText(titleText);
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
                Intent intent = new Intent(First.this, website.class);
                startActivity(intent);

                return true;
            }
            case R.id.set2: {
                Intent intent = new Intent(First.this, Member.class);
                startActivity(intent);

                return true;
            }
            case R.id.set3: {
                Intent intent = new Intent(First.this, Logout.class);
                startActivity(intent);

                return true;
            }


            case android.R.id.home:
            {
                AlertDialog.Builder alertBuilder = new AlertDialog.Builder(context);

                alertBuilder
                        .setTitle("알림")
                        .setMessage("종료하시겠습니까?")
                        .setCancelable(true)
                        .setPositiveButton("확인", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                Intent intent = new Intent(First.this, Logout.class);
                                startActivity(intent);

                            }
                        });
                AlertDialog dialog = alertBuilder.create();
                dialog.show();
            }


            default:
                return false;
        }
    }

    @Override
    public void onBackPressed()
    {
        long tempTime = System.currentTimeMillis();
        long intervalTime = tempTime - backPressedTime;

        if (0 <= intervalTime && FINISH_INTERVAL_TIME >= intervalTime)
        {
            super.onBackPressed();
        }
        else
        {
            backPressedTime = tempTime;
            Toast.makeText(getApplicationContext(), "한번더 누르면 앱을 종료합니다.", Toast.LENGTH_SHORT).show();
        }
    }

}
