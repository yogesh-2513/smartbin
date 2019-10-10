package com.developer.yogesh.smartbin;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

public class SignupActivity extends AppCompatActivity implements View.OnClickListener{

    EditText username,password;
    TextView textView;
    Button button;
    String uname,pword;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);
        ActionBar actionBar=getSupportActionBar();
        if(actionBar!=null){
            actionBar.setTitle("User Registration");
        }
        initialise();
    }
    public void initialise(){
        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);
        textView = (TextView) findViewById(R.id.gotologin);
        button = (Button) findViewById( R.id.signup);
        button.setOnClickListener(this);
        textView.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.signup:
                signup();
                break;
            case R.id.gotologin:
                startActivity(new Intent(SignupActivity.this,LoginActivity.class));
                finish();
                break;
        }
    }

    public void signup(){

        if(username.getText().toString().equals("")){
            username.setError("Username is required !!");
        }else if(password.getText().toString().equals("")){
            password.setError("Password is required !!");
        }else{
            this.uname=username.getText().toString();
            this.pword=password.getText().toString();
            RegisterUser registerUser=new RegisterUser();
            registerUser.execute();
        }
    }
    public class RegisterUser extends AsyncTask<Void,Void,String>{

        String result;

        @Override
        protected void onPostExecute(String s) {

            super.onPostExecute(s);

            try {
                JSONObject jsonObject=new JSONObject(s);
                int error=jsonObject.getInt("error");
                String msg=jsonObject.getString("msg");
                if(error == 0){
                    Toast.makeText(getApplicationContext(),msg,Toast.LENGTH_SHORT).show();
                    startActivity(new Intent(SignupActivity.this, LoginActivity.class));
                }else{
                    Toast.makeText(getApplicationContext(),msg,Toast.LENGTH_LONG).show();
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

        @Override
        protected String doInBackground(Void... voids) {
            JSONObject jsonObject=new JSONObject();

            try {
                jsonObject.put("action","user_signup");
                jsonObject.put("username",uname);
                jsonObject.put("password",pword);

                JsonParser jsonParser=new JsonParser(Constant.url,"POST",jsonObject);
                result=jsonParser.makeReq();
            } catch (JSONException e) {
                e.printStackTrace();
            }

            return result;
        }
    }
}


