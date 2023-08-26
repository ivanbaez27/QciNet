package com.example.cucei_tres.adatpter

import android.view.View
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.recyclerview.widget.RecyclerView
import androidx.recyclerview.widget.RecyclerView.ViewHolder
import com.bumptech.glide.Glide
import com.example.cucei_tres.Publicaciones
import com.example.cucei_tres.R
import com.squareup.picasso.Picasso

class publicacionHolder(view: View, ):RecyclerView.ViewHolder(view) {

    private var isClicked = false
    val nombreCordi = view.findViewById<TextView>(R.id.tvCoordinacion)
    val contenidoPublicacion = view.findViewById<TextView>(R.id.tvContenidoPublicacion)
    val hashtag = view.findViewById<TextView>(R.id.tvHashTag)
    val imagen = view.findViewById<ImageView>(R.id.ivPublicacion)
    val imagenCorazon = view.findViewById<ImageView>(R.id.likeButton)

    fun render(publicacionesModel: Publicaciones, onClickListener:(Publicaciones) -> Unit ){
        nombreCordi.text = publicacionesModel.cordinacion
        contenidoPublicacion.text = publicacionesModel.contenido
        hashtag.text = publicacionesModel.hashtag
        Picasso.get().load(publicacionesModel.imagen).into(imagen)


        //Glide.with(imagen).load(publicacionesModel.imagen).into(imagen)
        imagenCorazon.setOnClickListener{
            if (isClicked) {
                imagenCorazon.setImageResource(R.drawable.corazon_vacio)
                itemView.findViewById<TextView>(R.id.tvlikes).text = "0 Me gusta"

            } else {
                imagenCorazon.setImageResource(R.drawable.corazon)
                itemView.findViewById<TextView>(R.id.tvlikes).text = "1 Me gusta"

            }
            isClicked = !isClicked
        }
        itemView.setOnClickListener{

            onClickListener(publicacionesModel)

        }

        }
    }




