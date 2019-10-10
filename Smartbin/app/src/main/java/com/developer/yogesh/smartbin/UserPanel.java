package com.developer.yogesh.smartbin;

import android.app.ActionBar;
import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;

import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

public class UserPanel extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    private String[] rewards;
    private String points;
    private String userID;
    private String qrResult;
    TextView userPoints,userid;
    ListView listView;
    Activity activity;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        activity=this;
        setContentView(R.layout.activity_user_panel);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
//        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        Intent intent=getIntent();

        userID=intent.getStringExtra("userID");
        points=intent.getStringExtra("points");
        rewards=intent.getStringArrayExtra("rewards");

        userid=(TextView) findViewById(R.id.userID);
        userid.setText(userID);
        userPoints=(TextView) findViewById(R.id.points);
        userPoints.setText(points);
        listView=(ListView) findViewById(R.id.listview);
        MyAdapter myAdapter=new MyAdapter(getApplicationContext(),rewards);
        listView.setAdapter(myAdapter);
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.user_panel, menu);
        return true;
    }



    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_camera) {
//            startActivity(new Intent(UserPanel.this,Scanner.class).putExtra("userID",userID));
            openScanner();
        }else if( id == R.id.userlogout){
            startActivity(new Intent(UserPanel.this,LoginActivity.class));
            finish();
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    public  void  openScanner(){
        IntentIntegrator integrator = new IntentIntegrator(activity);
        integrator.setDesiredBarcodeFormats(IntentIntegrator.ALL_CODE_TYPES);
        integrator.setPrompt("Scan ");
        integrator.setCameraId(0);
        integrator.setBeepEnabled(false);
        integrator.setBarcodeImageEnabled(false);
        integrator.initiateScan();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        IntentResult result = IntentIntegrator.parseActivityResult(requestCode, resultCode, data);
        if(result != null) {
            if(result.getContents() == null) {
                final int d = Log.d("MainActivity", "Cancelled scan");
                Toast.makeText(this, "Cancelled", Toast.LENGTH_LONG).show();
            } else {
                Log.d("MainActivity", "Scanned");
                qrResult=result.getContents();
                Toast.makeText(this, "Scanned: " + result.getContents(), Toast.LENGTH_LONG).show();
                UpdateReward updateReward=new UpdateReward();
                updateReward.execute();
            }
        } else {
            // This is important, otherwise the result will not be passed to the fragment
            super.onActivityResult(requestCode, resultCode, data);
        }
    }

    public class UpdateReward extends AsyncTask<Void,Void,String> {
        String res;
        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            try {
                Log.e("Res",s);
                JSONObject jsonObject=new JSONObject(s);

                int error=jsonObject.getInt("error");
                Toast.makeText(getApplicationContext(),jsonObject.getString("msg"),Toast.LENGTH_LONG).show();
                int add=Integer.parseInt(points)+5;
                userPoints.setText(Integer.toString(add));
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
                Log.e("Res",res);
            } catch (JSONException e) {

                e.printStackTrace();
            }
            return  res;
        }
    }
}
