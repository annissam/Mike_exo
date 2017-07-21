package com.example.niroan.chatandroid_cheickalavoudine_jeyathasan;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.R;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONException;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class ChatActivity extends AppCompatActivity {

    public ListView lv;
    public ArrayAdapter<Message> adapter = null;

    public ArrayList<Message> listMessages;
    public Message[] messages;

    public MessageRetriever msgRetriever;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chat);

        lv = (ListView) findViewById(R.id.listview_messages);
        listMessages = new ArrayList<Message>();

        adapter = new ListAdapter(this, R.layout.rowlayout, listMessages);

        /*adapter = new ArrayAdapter<>(this, R.layout.rowlayout, listMessages){
            @Override
            @Nullable
            public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent){
                convertView = super.getView(position, convertView, parent);
                TextView tv = (TextView) convertView;
                Message message = listMessages.get(position);
                tv.setText("fgser");
                return tv;
            }
        };*/

        lv.setAdapter(adapter);

        msgRetriever = new MessageRetriever(ChatActivity.this);

        msgRetriever.execute("http://10.0.2.2:2017/android");
    }

    /**
     * Permet de reinitialiser la liste des messages
     */
    public void clearChatList() {

        listMessages.clear();
        adapter.notifyDataSetChanged();
    }

    public void addReceiveMessage(final Message message) {
        listMessages.add(message);
        adapter.notifyDataSetChanged();

        /*lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                SimpleDateFormat formatter = new SimpleDateFormat("HH:mm");
                String dateString = formatter.format(new Date(message.getTimestamp()));
                Toast.makeText(getApplicationContext(), message.getAuthor() + " " + dateString, Toast.LENGTH_SHORT).show();
            }
        });*/

        for(int i = 0; i < listMessages.size(); i++){
            Log.v("liste" , listMessages.get(i).getBody());
        }
    }

    public void sendMessage(Message message) {
        addReceiveMessage(message);
    }

    public void onClickSend(View v) throws IOException, JSONException {
        EditText et = (EditText) findViewById(R.id.edittext_message);
        if (et.getText().toString().equals("")) {
            Toast t = Toast.makeText(this, "Message null", Toast.LENGTH_SHORT);
            t.show();
        } else {
            Message message = new Message(1, "caca", "Safrine", System.currentTimeMillis(), et.getText().toString());
            sendMessage(message);
        }

    }
}
