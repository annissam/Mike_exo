package com.example.niroan.chatandroid_cheickalavoudine_jeyathasan;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by Niroan on 19/04/2017.
 */

public class Message {

    public long id;
    public String queue;
    public String author;
    public long timestamp;
    public String body;

    public Message (long id, String queue, String author, long timestamp, String body){
        this.id = id;
        this.queue = queue;
        this.author = author;
        this.timestamp = timestamp;
        this.body = body;
    }


    public long getId() {
        return id;
    }

    public String getQueue() {
        return queue;
    }

    public long getTimestamp() {
        return timestamp;
    }

    public String getAuthor() {
        return author;
    }

    public String getBody(){
        return body;
    }

    public static Message fromJson(String json) throws JSONException {

        JSONObject object = new JSONObject(json);
        Message message = new Message(0, "caca", object.optString("author"), object.optLong("timestamp"), object.optString("message"));
        return message;
    }

    @Override
    public String toString(){
        return id + " " + queue + " " + author + " " + timestamp + " " + body;
    }

}
