package com.tarks.ocrtest4;

import android.app.Application;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

import java.util.List;

public class TradeViewAdapter extends BaseAdapter {

    // Adapter에 추가된 데이터를 저장하기 위한 ArrayList
    private  Context context;
    Application application;
    private List<TradeViewItem> userList;
    // private ArrayList<ListViewItem> listViewItemList = new ArrayList<ListViewItem>() ;

    // ListViewAdapter의 생성자
    public TradeViewAdapter(Context context, List<TradeViewItem> userlist)
    {
        this.context = context;
        this.userList = userlist;
    }

    // Adapter에 사용되는 데이터의 개수를 리턴. : 필수 구현
    @Override
    public int getCount() {
        return userList.size() ;
    }

    // position에 위치한 데이터를 화면에 출력하는데 사용될 View를 리턴. : 필수 구현
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        final int pos = position;
        final Context context = parent.getContext();

        // "listview_item" Layout을 inflate하여 convertView 참조 획득.
        if (convertView == null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(R.layout.tradeview_item, parent, false);
        }

        // 화면에 표시될 View(Layout이 inflate된)으로부터 위젯에 대한 참조 획득
        TextView nameTextView = (TextView) convertView.findViewById(R.id.textView_tradelist_name);
        TextView nickTextView = (TextView) convertView.findViewById(R.id.textView_tradelist_nick);
        TextView jobTextView = (TextView) convertView.findViewById(R.id.textView_tradelist_job);

        // Data Set(listViewItemList)에서 position에 위치한 데이터 참조 획득
        TradeViewItem tradeViewItem = userList.get(position);

        //iconImageView.setImageBitmap(listViewItem.getCard_());
        nameTextView.setText(tradeViewItem.getName());
        nickTextView.setText(tradeViewItem.getNikname());
        jobTextView.setText(tradeViewItem.getJob());

        return convertView;
    }

    // 지정한 위치(position)에 있는 데이터와 관계된 아이템(row)의 ID를 리턴. : 필수 구현
    @Override
    public long getItemId(int position) {
        return position ;
    }

    // 지정한 위치(position)에 있는 데이터 리턴 : 필수 구현
    @Override
    public Object getItem(int position) {
        return userList.get(position) ;
    }

}
