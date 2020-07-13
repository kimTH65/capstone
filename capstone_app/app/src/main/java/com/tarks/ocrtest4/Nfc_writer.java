package com.tarks.ocrtest4;

import android.app.Activity;
import android.nfc.NdefMessage;
import android.nfc.NdefRecord;
import android.nfc.NfcAdapter;
import android.os.Bundle;
import android.widget.TextView;

import java.nio.charset.Charset;
import java.util.HashMap;
import java.util.Locale;

public class Nfc_writer extends Activity
{
    private TextView text; //텍스트뷰변수
    SessionManager sessionManager; // 전역에서사용하기위해세션선언
    /*

     * NFC 통신관련변수

     */
    private NfcAdapter nfcAdapter;
    private NdefMessage mNdeMessage; //NFC 전송메시지
    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nfc);

        text = (TextView) findViewById(R.id.text);

        sessionManager = new SessionManager(this); // 세션생성
        sessionManager.checkLogin(); // 로그인되어있는지체크함
        HashMap<String, String> user = sessionManager.getUserDetail(); // user 라는해시맵을만들어서세션값을관리함
        String id = user.get(sessionManager.ID); // mId에현재로그인한사용자정보를저장함

        nfcAdapter = NfcAdapter.getDefaultAdapter(this); // nfc를지원하지않는단말기에서는null을반환.

        if (nfcAdapter == null)
        {
            text.setText("NFC 기능이꺼져있습니다. 켜주세요" + nfcAdapter + "");
        }
        else if (nfcAdapter != null)
        {
            text.setText("NFC 단말기를접촉해주세요" + nfcAdapter + "");
        }
        mNdeMessage = new NdefMessage
                (
                        new NdefRecord[]
                                {
                                        createNewTextRecord("http://54.175.31.167/template_page/repre_template-"+id,
                                                Locale.ENGLISH, true),                        //텍스트데이터
//createNewTextRecord("잘됩니까?", Locale.ENGLISH, true),    //텍스트데이터
//createNewTextRecord("안되면소리를질러주세요", Locale.ENGLISH, true),           //텍스트데이터
//createNewTextRecord("제발요..", Locale.ENGLISH, true),    //텍스트데이터
//createNewTextRecord("제바알..", Locale.ENGLISH, true),                  //텍스트데이터
                                }

                );

    }

    @Override
    protected void onResume()
    {
        super.onResume();
        if (nfcAdapter != null)
        {
            nfcAdapter.enableForegroundNdefPush(this, mNdeMessage);

        }
    }
    @Override
    protected void onPause()
    {
        super.onPause();
        if (nfcAdapter != null)
        {
            nfcAdapter.disableForegroundNdefPush(this);
        }
    }
    public static NdefRecord createNewTextRecord(String text, Locale locale, boolean encodelnUtf8)
    {
        byte[] langBytes = locale.getLanguage().getBytes(Charset.forName("US-ASCII"));

        Charset utfEncoding = encodelnUtf8 ? Charset.forName("UTF-8"):Charset.forName("UTF-16");
        byte[] textBytes = text.getBytes(utfEncoding);

        int utfBit = encodelnUtf8 ? 0:(1<<7);
        char status = (char)(utfBit + langBytes.length);
        byte[] data = new byte[1 + langBytes.length + textBytes.length];
        data[0] = (byte)status;
        System.arraycopy(langBytes, 0, data, 1, langBytes.length);
        System.arraycopy(textBytes, 0, data, 1 + langBytes.length, textBytes.length);

        return new NdefRecord(NdefRecord.TNF_WELL_KNOWN,NdefRecord.RTD_TEXT, new byte[0], data);

    }
}
