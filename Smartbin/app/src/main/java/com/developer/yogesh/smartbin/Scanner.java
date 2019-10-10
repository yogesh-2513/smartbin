package com.developer.yogesh.smartbin;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import com.budiyev.android.codescanner.CodeScanner;
import com.budiyev.android.codescanner.CodeScannerView;
import com.budiyev.android.codescanner.DecodeCallback;
import com.google.zxing.Result;

import org.json.JSONException;
import org.json.JSONObject;


public class Scanner extends AppCompatActivity {

    private CodeScannerView codeScannerView;
    private CodeScanner scanner;
    String qrResult=null;
    String userID=null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_scanner);
        codeScannerView=(CodeScannerView) findViewById(R.id.scannerview);
        scanner=new CodeScanner(getApplicationContext(),codeScannerView);

        ActionBar actionBar=getSupportActionBar();
        actionBar.setHomeButtonEnabled(true);

        Intent intent=getIntent();
        userID=intent.getStringExtra("userID");

        scanner.setDecodeCallback(new DecodeCallback() {
            @Override
            public void onDecoded(@NonNull final Result result) {
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        qrResult=result.getText();
                        update();

                    }
                });
            }
        });

        codeScannerView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                scanner.startPreview();
            }
        });

    }

    public void update(){
        Log.e("QR ",qrResult);
        if(qrResult !=null){
            UpdateReward updateReward=new UpdateReward();
            updateReward.execute();
        }
    }

    @Override
    protected void onResume() {
        super.onResume();
        scanner.startPreview();
    }

    @Override
    protected void onPause() {
        scanner.releaseResources();
        super.onPause();
    }

    public class UpdateReward extends AsyncTask<Void,Void,String>{
        String res;
        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            try {
                JSONObject jsonObject=new JSONObject(s);
                int error=jsonObject.getInt("error");
                Toast.makeText(getApplicationContext(),jsonObject.getString("msg"),Toast.LENGTH_LONG).show();
                if(error == 0){

                    finish();
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

        @Override
        protected String doInBackground(Void... voids) {
            JSONObject jsonObject=new JSONObject();
            try {
                jsonObject.put("userID",userID);
                jsonObject.put("qrResult",qrResult);
                jsonObject.put("action","update_reward");
                JsonParser jsonParser=new JsonParser(Constant.url,"POST",jsonObject);
                res=jsonParser.makeReq();
            } catch (JSONException e) {
                e.printStackTrace();
            }

            return  res;
        }
    }
}

