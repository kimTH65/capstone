package com.tarks.ocrtest4;

import android.content.Context;
import android.util.AttributeSet;
import android.view.LayoutInflater;
import android.widget.ImageView;
import android.widget.LinearLayout;

import androidx.annotation.Nullable;

import com.bumptech.glide.Glide;

public class SingerViewer extends LinearLayout {

    ImageView imageView;



    public SingerViewer(Context context) {
        super(context);

        init(context);
    }

    public SingerViewer(Context context, @Nullable AttributeSet attrs) {
        super(context, attrs);

        init(context);
    }

    public void init(Context context){
        LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        inflater.inflate(R.layout.gridview_item,this,true);

        imageView = (ImageView) findViewById(R.id.gridView_image);
    }

    public void setItem(SingerItem singerItem){

        Glide.with(this).load(singerItem.getImage()).override(1000, 800).placeholder(R.drawable.unnamed).into(imageView);

    }
}
