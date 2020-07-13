package com.tarks.ocrtest4;

import android.app.Activity;
import android.app.PendingIntent;
import android.content.Intent;
import android.content.IntentFilter;
import android.nfc.NdefMessage;
import android.nfc.NdefRecord;
import android.nfc.NfcAdapter;
import android.nfc.tech.NfcF;
import android.os.Bundle;
import android.os.Parcelable;
import android.text.util.Linkify;
import android.util.Log;
import android.view.Menu;
import android.webkit.WebView;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.util.EncodingUtils;

import androidx.appcompat.app.AppCompatActivity;

import java.util.Arrays;

public class Nfc extends Activity
{
    private NfcAdapter nfcAdapter;
    private PendingIntent pendingIntent;
    private IntentFilter[] mlntentFilters;
    private String[][] mNFCTechLists;
    private TextView text;
    int j;
    String mId;

    private WebView webView;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nfc);

        text = (TextView)findViewById(R.id.text); //위젯선언

        nfcAdapter = NfcAdapter.getDefaultAdapter(this);
        if (nfcAdapter == null)
        {
            Toast.makeText(this, "NFC is not available", Toast.LENGTH_LONG).show();
            finish();
            return;
        }
        else
        {
            Toast.makeText(this, "NFC 기기를맞대주세요", Toast.LENGTH_LONG).show();
        }

        Intent intent = new Intent(this, Nfc_second.class);
        pendingIntent = PendingIntent.getActivity(this, 0, intent, 0);

        IntentFilter ndefIntent = new IntentFilter(NfcAdapter.ACTION_NDEF_DISCOVERED); // Intent to start an activity when a tag with NDEF payload is discovered.

        try
        {
            ndefIntent.addDataType("*/*");
        }
        catch(Exception e)
        {
            Log.e("TagDispatch", e.toString());
        }
        mlntentFilters = new IntentFilter[] {ndefIntent,};
        mNFCTechLists = new String[][] { new String[]{ NfcF.class.getName()}};

        webView = (WebView) findViewById(R.id.webView);
        webView.getSettings().setJavaScriptEnabled(true);


// 수정된부분
        webView.getSettings().setLoadWithOverviewMode(true); // 웹뷰화면맞추기
        webView.getSettings().setUseWideViewPort(true);
        webView.setScrollBarStyle(WebView.SCROLLBARS_OUTSIDE_OVERLAY);
        webView.setScrollbarFadingEnabled(true);
// 여기까지

    }
    @Override
    protected void onResume()
    {
        super.onResume();

        /*

         * NFC 태그가사용가능할경우(nfcAdapter가null 이아닐경우)에작동

         */
        if (nfcAdapter != null)
        {
            nfcAdapter.enableForegroundDispatch(this, pendingIntent, mlntentFilters, mNFCTechLists);
        }
    }
    @Override

    protected void onPause() { //화면이중지될때사용안하기위해

//onPause() 에서.disableForegroundDispatch(this); 사용

        super.onPause();

        if (nfcAdapter != null) {



            nfcAdapter.disableForegroundDispatch(this); //수신

            finish();

        }
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu)
    {
// Inflate the menu; this adds items to the action bar if it is present.
//getMenuInflater().inflate(R.menu.main,menu);
        return true;
    }

    protected void onNewIntent(Intent intent) { //테그데이터를전달받았을때태그정보를화면에보여줌.

        String s = ""; // 글씨를띄우는데사용
        Parcelable[] data = intent.getParcelableArrayExtra(NfcAdapter.EXTRA_NDEF_MESSAGES); // EXTRA_NDEF_MESSAGES : 여분의배열이태그에존재한다.
        /*

         * 조건이널이아닌경우에글씨& 그림으로변환작업을한다.

         * 널인경우에는메소드가작동하지않는다.

         */
        if (data != null) {
            /*

             * 이러한처리르한다.

             * 이러한처리에서벗어나면예외처리를통해출력해준다.

             */
            try {

                for (int i = 0; i < data.length; i++) {
                    NdefRecord[] recs = ((NdefMessage) data[i]).getRecords();
                    for (j = 0; j < recs.length; j++) {
                        /*
                         * byte로날라온텍스트처리
                         */
                        if (recs[j].getTnf() == NdefRecord.TNF_WELL_KNOWN && Arrays.equals(recs[j].getType(), NdefRecord.RTD_TEXT)) {
                            byte[] payload = recs[j].getPayload();
                            String textEncoding = ((payload[0] & 0200) == 0) ? "UTF-8" : "UTF-16";
                            int langCodeLen = payload[0] & 0077;
                            s += ("\n" + new String(payload, langCodeLen + 1, payload.length - langCodeLen - 1, textEncoding));

                        }

                    }

                }


            } catch (Exception e) {
                Log.e("TagDispatch", e.toString());
            }
        }
//Linkify.addLinks(text, Linkify.WEB_URLS);

    }

}

