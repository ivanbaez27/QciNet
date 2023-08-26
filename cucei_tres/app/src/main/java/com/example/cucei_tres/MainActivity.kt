package com.example.cucei_tres

import android.content.Intent
import android.icu.text.SimpleDateFormat
import android.icu.util.TimeZone
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.text.format.DateUtils
import android.widget.SearchView
import android.widget.Toast
import androidx.appcompat.widget.SearchView.OnQueryTextListener
import androidx.core.splashscreen.SplashScreen.Companion.installSplashScreen
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.DividerItemDecoration
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.cucei_tres.APIService.APIService
import com.example.cucei_tres.Response.ResponsePost
import com.example.cucei_tres.adatpter.publicacionAdapter
import com.example.cucei_tres.databinding.ActivityMainBinding
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import java.util.Locale


class MainActivity : AppCompatActivity(), SearchView.OnQueryTextListener {

    private lateinit var  binding: ActivityMainBinding
    private val provedorPost = mutableListOf<String>()

    override fun onCreate(savedInstanceState: Bundle?) {
        val screenSplash = installSplashScreen()
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)
        binding.buscador.setOnQueryTextListener(this)
        binding.btnNavegation.setOnItemSelectedListener {

            when(it.itemId){
                R.id.btn_home -> {
                    val intent = Intent(this, MainActivity::class.java)
                    startActivity(intent)
                    finish()
                }
                R.id.btn_perfil -> replaceFragment(Profile())
                else -> {

                }
            }
            true

        }
        initRecyclerView()
        loadAndDisplayPublications()
        screenSplash.setKeepOnScreenCondition{ false }

    }

    private fun initRecyclerView(){
        val manager = LinearLayoutManager(this)
        val decoration = DividerItemDecoration(this, manager.orientation )


        binding.publicacionesQcei.layoutManager = LinearLayoutManager(this)
        binding.publicacionesQcei.adapter = publicacionAdapter(PublicaiconesProvider.computacionPublicaciones) {
                publicaciones -> onItemSelected(publicaciones)
        }
    }

    override fun onBackPressed() {

        val intent = Intent(this, MainActivity::class.java)
        startActivity(intent)
        finish()

    }

    private fun replaceFragment(fragment:Fragment){
        val fragmentManager = supportFragmentManager
        val fragmentTransaction = fragmentManager.beginTransaction()
        fragmentTransaction.replace(R.id.frameLayout,fragment)
        fragmentTransaction.commit()


    }
    fun onItemSelected(publicaciones :Publicaciones){
        Toast.makeText(this,publicaciones.hashtag,Toast.LENGTH_SHORT).show()


    }

    private fun getRetrofit(): Retrofit {
        return Retrofit.Builder()
            .baseUrl("http://10.0.2.2:8000/")
            .addConverterFactory(GsonConverterFactory.create())
            .build()
    }
    private fun loadAndDisplayPublications(){
        CoroutineScope(Dispatchers.IO).launch {
            val call = getRetrofit().create(APIService::class.java).getPostByCarrear("datapost")
            val response = call.body()
            val img = getRetrofit().create(APIService::class.java).getPostByCarrear("storage/")
            runOnUiThread {
                if (call.isSuccessful && response != null) {

                    val mutableList = mutableListOf<Pair<String, String>>() // Lista mutable para almacenar caption e image

                    for (post in response) { // Usar la respuesta de Retrofit directamente
                        val modifiedImageURL = "http://10.0.2.2:8000/storage/" + post.imagen
                        val newPublicacion = Publicaciones(
                            post.contenido,
                            modifiedImageURL,
                            "Ingenierira en computacion",
                            formatDate(post.timePost)
                        )
                        val alreadyExists = PublicaiconesProvider.computacionPublicaciones.any { it.contenido == newPublicacion.contenido && it.imagen == newPublicacion.imagen }
                        if (!alreadyExists) {
                            PublicaiconesProvider.computacionPublicaciones.add(newPublicacion)
                        }

                    }

                } else {
                    showError()
                }
            }
        }
    }

    private fun formatDate(dateTime: String): String {
        val sdf = SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss.SSSSSS'Z'", Locale.getDefault())
        sdf.timeZone = TimeZone.getTimeZone("UTC")
        val date = sdf.parse(dateTime)
        return DateUtils.getRelativeTimeSpanString(date.time, System.currentTimeMillis(), DateUtils.MINUTE_IN_MILLIS).toString()
    }


    private fun searchByName(query: String) {

    }


    private fun showError() {
        Toast.makeText(this,"Ha ocurrido un Error", Toast.LENGTH_SHORT).show()
    }

    override fun onQueryTextSubmit(query: String?): Boolean {
        if (!query.isNullOrEmpty()){
            searchByName(query.toLowerCase())
        }
        return true


    }

    override fun onQueryTextChange(newText: String?): Boolean {
        return true
    }


}