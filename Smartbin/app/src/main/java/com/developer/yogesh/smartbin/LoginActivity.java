package com.developer.yogesh.smartbin;

import android.Manifest;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class LoginActivity extends AppCompatActivity implements View.OnClickListener{

    EditText loginusername,loginpassword;
    public int PERMISSION_REQUEST_CODE=1;
    Button btnlogin;
    TextView textView;
    private String uname,pword;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        ActionBar actionBar=getSupportActionBar();
        if(actionBar != null){
            actionBar.setTitle("User Login");
        }

        btnlogin=(Button) findViewById(R.id.loginbuttn);
        textView=(TextView) findViewById(R.id.gotosignup);
        btnlogin.setOnClickListener(this);
        textView.setOnClickListener(this);
    }

    public void initialise(){

        loginusername=(EditText) findViewById(R.id.loginusername);
        loginpassword=(EditText) findViewById(R.id.loginpassword);

        if(loginusername.getText().equals("")){
            loginusername.setError("Username is required !!");
        }else if(loginpassword.getText().equals("")){
            loginpassword.setError("Password is required !!");
        }else{
           this.uname=loginusername.getText().toString();
           this.pword=loginpassword.getText().toString();
           ValidateUser validateUser=new ValidateUser();
           validateUser.execute();
        }
    }

    @Override
    public void onClick(View v) {

        switch (v.getId()){
            case R.id.loginbuttn:
                initialise();
                break;
            case R.id.gotosignup:
                Log.e("Event","Clicked !!");
                startActivity(new Intent(LoginActivity.this,SignupActivity.class));
                finish();
                break;
        }

    }

    public  class ValidateUser extends AsyncTask<Void,Void,String>{

        JSONObject jsonObject=new JSONObject();
        JsonParser jsonParser;
        String result=null;

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            try {
                JSONObject jsonObject =new JSONObject(s);
                int error=jsonObject.getInt("error");

                if(error == 0){

                    String points=jsonObject.getString("points");
                    String userID=jsonObject.getString("userID");
                    JSONArray jsonArray =jsonObject.getJSONArray("rewards");
                    Log.e("Array",jsonArray.toString());

                    String[] rewards= new String[jsonArray.length()];

                    for (int i=0;i<jsonArray.length();i++){
                        rewards[i]="Reward : "+jsonArray.getJSONObject(i)
                                .getString("reward") + "                                                      " + "Reward points : "+  jsonArray.getJSONObject(i).getString("points");
                        Log.e("Reward",rewards[i]);
                    }
                    startActivity(new Intent(LoginActivity.this,UserPanel.class)
                            .putExtra("rewards",rewards)
                            .putExtra("userID",userID)
                            .putExtra("points",points)
                            );
                    finish();

                }else{
                    Toast.makeText(getApplicationContext(),"Invalid credentials !!",Toast.LENGTH_SHORT).show();
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

        @Override
        protected String doInBackground(Void... voids) {
            try {
                jsonObject.put("action","user_login");
                jsonObject.put("username",uname);
                jsonObject.put("password",pword);
                jsonParser = new JsonParser(Constant.url,"POST",jsonObject);
                result = jsonParser.makeReq();
            } catch (JSONException e) {
                e.printStackTrace();
            }
            return result;
        }
    }
}
