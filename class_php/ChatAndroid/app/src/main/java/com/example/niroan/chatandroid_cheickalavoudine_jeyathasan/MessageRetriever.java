package com.example.niroan.chatandroid_cheickalavoudine_jeyathasan;

import android.os.AsyncTask;
import android.util.Log;

import org.json.JSONException;

import java.io.IOException;
import java.lang.ref.WeakReference;

/**
 * Created by Niroan on 08/05/2017.
 */

public class MessageRetriever extends AsyncTask<String, Message, Void> {

    private WeakReference<ChatActivity> mActivity = null;


    public MessageRetriever (ChatActivity activity){
        link(activity);
    }
    public void link (ChatActivity pActivity) {
        mActivity = new WeakReference<ChatActivity>(pActivity);
    }

    @Override
    protected Void doInBackground(String ... args) {

        ChatIO chat = new ChatIO();
        Message message;

        try {

            String url = args[0];

            message = chat.fetchMessage(url, "android", 0);
            publishProgress(message);

        } catch (IOException e) {
            e.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return null;
    }

    @Override
    protected void onPreExecute()
    {
        super.onPreExecute();
        // ce code est exécuté sur la thread principale avant le démarrage de la tâche de récupération
    }

    @Override
    protected void onPostExecute(Void o)
    {
        super.onPostExecute(o);
        // ce code est exécuté sur la thread principale après la fin de la tâche
        // il peut être intéressant pour publier sur l'UI le résultat final de la tâche
        // ici ce n'est pas utile car nous nous intéressions plutôt aux informations de progrès
        // plutôt qu'au résultat final
    }

    @Override
    protected void onProgressUpdate(Message... values)
    {
        super.onProgressUpdate(values);
        mActivity.get().addReceiveMessage(values[0]);
        // on récupère ici les messages postés avec publishProgress()
        // le code de cette méthode est exécuté sur la thread principale
        // on peut donc l'utiliser pour mettre à jour l'UI en appelant la méthode
        // addReceivedMessage(message) de l'activité
        // la difficulté est qu'il faut avoir une référence vers l'instance de l'activité en cours
        // d'exécution: on peut rajouter une méthode statique getInstance() dans ChatActivity qui retourne
        // l'instance courante (avec initialisation dans le onCreate())
    }

    @Override
    protected void onCancelled()
    {
        super.onCancelled();
        // code exécuté sur la thread principale lorsque la tâche est annulée
    }
}
