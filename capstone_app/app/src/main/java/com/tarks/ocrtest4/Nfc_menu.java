package com.tarks.ocrtest4;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

public class Nfc_menu extends AppCompatActivity
{
    Toolbar toolbar;
    ActionBar actionBar;

    Button reader;
    Button writer;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nfc_menu);

        reader = (Button)findViewById(R.id.Reader);
        writer = (Button)findViewById(R.id.Writer);

        toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        actionBar = getSupportActionBar();
        actionBar.setDisplayShowCustomEnabled(true);
        actionBar.setDisplayShowTitleEnabled(false);//기본 제목을 없애줍니다.
        actionBar.setDisplayHomeAsUpEnabled(true);//뒤로가기 버튼

    }

    public void Reader(View view)
    {
        Intent intent_onClick = new Intent(getApplicationContext(), Nfc.class);
        startActivity(intent_onClick);
        finish();
    }
    public void Writer(View view)
    {
        Intent intent_onClick = new Intent(getApplicationContext(), Nfc_writer.class);
        startActivity(intent_onClick);
        finish();
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
                Intent intent = new Intent(Nfc_menu.this, website.class);
                startActivity(intent);

                return true;
            }
            case R.id.set2: {
                Intent intent = new Intent(Nfc_menu.this, Member.class);
                startActivity(intent);

                return true;
            }
            case R.id.set3: {
                Intent intent = new Intent(Nfc_menu.this, Logout.class);
                startActivity(intent);

                return true;
            }


            case android.R.id.home:
            {

                Intent intent = new Intent(Nfc_menu.this, First.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);

            }


            default:
                return false;
        }
    }

}