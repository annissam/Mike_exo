package com.example.niroan.chatandroid_cheickalavoudine_jeyathasan;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;
import android.R;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

/**
 * Created by Niroan on 09/05/2017.
 */

public class ListAdapter extends ArrayAdapter<Message> {

    public ArrayList<Message> messages = new ArrayList<>();

    public ListAdapter(Context context, int resource, ArrayList<Message> objects) {
        super(context, resource, objects);
        messages = objects;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        LayoutInflater inflater = (LayoutInflater)
                getContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        View rowView = inflater.inflate(R.layout.rowlayout, parent, false);

        TextView textMessage = (TextView) rowView.findViewById(R.id.textMessage);
        TextView textAuthor = (TextView) rowView.findViewById(R.id.textAuthor);
        TextView textTime = (TextView) rowView.findViewById(R.id.textTime);

        Message message = messages.get(position);

        textMessage.setText(message.getBody());
        textAuthor.setText(message.getAuthor());
        SimpleDateFormat formatter = new SimpleDateFormat("HH:mm");
        String time = formatter.format(new Date(message.getTimestamp()));
        textTime.setText(time);

        if(position%2 == 0){
            textMessage.setBackgroundColor(Color.rgb(252, 255, 245));
            textAuthor.setBackgroundColor(Color.rgb(252, 255, 245));
            textTime.setBackgroundColor(Color.rgb(252, 255, 245));
        }else{
            textMessage.setBackgroundColor(Color.rgb(209, 219, 189));
            textAuthor.setBackgroundColor(Color.rgb(209, 219, 189));
            textTime.setBackgroundColor(Color.rgb(209, 219, 189));
        }

        if(convertView != null )
            rowView = (View)convertView;

        return rowView;
    }


}
