package com.example.niroan.chatandroid_cheickalavoudine_jeyathasan;

import android.util.Log;

import org.json.JSONException;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URL;
import java.net.URLConnection;

/**
 * Created by Niroan on 03/05/2017.
 */

public class ChatIO {

    public ChatIO(){}

    public  Message fetchMessage(String server, String queue, int id) throws IOException, JSONException {
        String url = server + "/" + id;
        Log.v("URL", url);
        URL website = new URL(url);
        URLConnection connection = website.openConnection();
        BufferedReader in = new BufferedReader(new InputStreamReader(connection.getInputStream()));

        StringBuilder response = new StringBuilder();
        String inputLine;

        while ((inputLine = in.readLine()) != null)
            response.append(inputLine);

        in.close();

        return Message.fromJson(response.toString());
    }
}
