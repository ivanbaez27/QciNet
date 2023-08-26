package com.example.cucei_tres.Response

import com.google.gson.annotations.SerializedName

data class ResponsePost(
    @SerializedName("id") val id: Int,
    @SerializedName("user_id") val user_id: Int,
    @SerializedName("major_id") val major_id: Int,
    @SerializedName("caption") var contenido : String,
    @SerializedName("image") var imagen : String,
    @SerializedName("likes") val likes: Int,
    @SerializedName("created_at") val timePost: String,
    @SerializedName("updated_at") val hashtag: String

)


