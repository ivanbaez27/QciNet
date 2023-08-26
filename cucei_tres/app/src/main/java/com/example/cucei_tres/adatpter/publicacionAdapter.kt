package com.example.cucei_tres.adatpter

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.example.cucei_tres.Publicaciones
import com.example.cucei_tres.R

class publicacionAdapter(private val publicacionesList: MutableList<Publicaciones>, private val onClickListener:(Publicaciones) -> Unit ) : RecyclerView.Adapter<publicacionHolder>(){



    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): publicacionHolder {
        val layoutInflater = LayoutInflater.from(parent.context)
        return publicacionHolder(layoutInflater.inflate(R.layout.inicio , parent, false))

    }

    override fun getItemCount(): Int = publicacionesList.size


    override fun onBindViewHolder(holder: publicacionHolder, position: Int) {
        val item = publicacionesList[position]
        holder.render(item,onClickListener)

    }



}