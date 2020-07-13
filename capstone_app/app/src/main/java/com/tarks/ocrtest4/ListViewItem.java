package com.tarks.ocrtest4;

import android.graphics.Bitmap;
import android.graphics.drawable.Drawable;

public class ListViewItem {

    //private Drawable iconDrawable ;
   // private String titleStr ;
    //private String descStr ;

    private  String card_image;
    private  String card_name;
    private  String card_phon;



    public ListViewItem(String card_image, String card_name, String card_phon){
        setCard_image(card_image);
        setCard_name(card_name);
        setCard_phon(card_phon);
    }





    public void setCard_image(String card_image) {

        this.card_image = card_image;

    }
    public void setCard_name(String card_name) {

        this.card_name = card_name;

    }
    public void setCard_phon(String card_phon) {

        this.card_phon = card_phon;

    }

    public String getCard_image() {
        return this.card_image;
    }
    public String getCard_name() {
        return this.card_name;
    }
    public String getCard_phon() {
        return this.card_phon;
    }

    /*
    public void setIcon(Drawable icon) {
        iconDrawable = icon ;
    }
    public void setTitle(String title) {
        titleStr = title ;
    }
    public void setDesc(String desc) {
        descStr = desc ;
    }

    public Drawable getIcon() {
        return this.iconDrawable ;
    }
    public String getTitle() {
        return this.titleStr ;
    }
    public String getDesc() {
        return this.descStr ;
    }

     */

}
