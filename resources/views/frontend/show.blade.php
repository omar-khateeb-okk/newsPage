@extends('layouts.app')

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@section('content')

<section class="section">
        <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-list clearfix">
                            <div class="blog-box row">
                                <div class="col-md-4">
                                    <div class="post-media">
                                        <h2>{{$post->name}}</h2>
                                            <img src="{{ asset('uploads/post/'.$post->img)}}" alt="" class="img-fluid">
                                            <div class="hovereffect"></div>
                                        </a>
                                    </div><!-- end media -->
                                </div><!-- end col -->

                                <div>

                                    <p>{{$post->description}}</p>
                                    <h5>tags:</h5>
                                    @foreach($post->tag as $tag )
                                        <small class="firstsmall"><a class="bg-orange" href="{{route('filter.posts.tag',['tag_id'=>$tag->id])}}"
                                                                     title="">{{$tag->name}}</a></small>
                                    @endforeach
                                    <h5>created at:</h5>
                                    <small><h8>{{$post->created_at}}</h8></small>
@endsection
