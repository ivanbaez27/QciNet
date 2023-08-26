package com.example.cucei_tres

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.EditText
import com.google.android.material.button.MaterialButton
import kotlin.properties.Delegates

class RegisterActivity : AppCompatActivity() {

    companion object{
         lateinit var usercode: String

    }
    private var code by Delegates.notNull<String>()
    private var password by Delegates.notNull<String>()
    private lateinit var etPassword: EditText
    private lateinit var etUser: EditText

    // private lateinit var mAuth:sql


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_register)

        etUser = findViewById(R.id.etUser)
        etPassword = findViewById(R.id.etPassword)


    }

    fun login(view : View) {
        loginUser()
    }
    private fun loginUser() {
        code = etUser.text.toString()
        //logica para el inicio de sesion mediante la autenticacion sql de la base de datos
        goHome(code)

    }
    private fun goHome(code:String){
        usercode = code

        val intent = Intent(this, MainActivity::class.java)
        startActivity(intent)
    }






}