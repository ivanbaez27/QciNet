package com.example.cucei_tres.APIService

import com.example.cucei_tres.Response.ResponsePost
import retrofit2.Response
import retrofit2.http.GET
import retrofit2.http.Url

interface APIService {

    @GET
    suspend fun getPostByCarrear(@Url URL: String): Response<List<ResponsePost>>
}
