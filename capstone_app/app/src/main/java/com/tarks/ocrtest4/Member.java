package com.tarks.ocrtest4;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

public class Member extends AppCompatActivity {


    Toolbar toolbar;
    ActionBar actionBar;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_member);

        toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        actionBar = getSupportActionBar();
        actionBar.setDisplayShowCustomEnabled(true);
        actionBar.setDisplayShowTitleEnabled(false);//기본 제목을 없애줍니다.
        actionBar.setDisplayHomeAsUpEnabled(true);//뒤로가기 버튼

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
                Intent intent = new Intent(Member.this, website.class);
                startActivity(intent);

                return true;
            }
            case R.id.set2: {
                Intent intent = new Intent(Member.this, Member.class);
                startActivity(intent);

                return true;
            }
            case R.id.set3: {
                Intent intent = new Intent(Member.this, Logout.class);
                startActivity(intent);

                return true;
            }


            case android.R.id.home:
            {

                Intent intent = new Intent(Member.this, First.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);

            }


            default:
                return false;
        }
    }
}
