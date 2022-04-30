@extends('theme::layouts.app')

@section('content')


<div class="relative px-8 pt-8 pb-20 mx-auto xl:px-5 max-w-7xl sm:px-6 lg:pt-10 lg:pb-28">
    <div class="absolute inset-0">
        <div class="bg-white h-1/3 sm:h-2/3"></div>
    </div>
    <div class="relative mx-auto max-w-7xl">
        <div class="flex flex-col justify-start">
            <h1 class="bg-clip-text bg-gradient-to-r from-yellow-400 via-red-400 to-purple-500 text-transparent text-3xl font-extrabold leading-9 tracking-tight sm:text-4xl sm:leading-10">
                {{ __('messages.Blog.ourAwesomeBlog') }}
            </h1>
            <p class="mt-3 text-xl leading-7 text-gray-500 sm:mt-4">
                {{ __('messages.Blog.checkTheBlog') }}
            </p>
            <ul class="flex self-start inline w-auto px-3 py-1 mt-3 text-xs font-medium text-white bg-gradient-to-r from-yellow-400 via-red-400 to-purple-500 rounded-md">
                <li class="mr-4 font-bold text-white uppercase">{{ __('messages.Blog.Categories') }}</li>
                @foreach($categories as $cat)
                <li class="@if(isset($category) && isset($category->slug) && ($category->slug == $cat->slug)){{ 'text-blue-700' }}@endif"><a href="{{ route('wave.blog.category', $cat->slug) }}">{{ $cat->name }}</a></li>
                @if(!$loop->last)
                <li class="mx-2">&middot;</li>
                @endif
                @endforeach
            </ul>
        </div>
        <div class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3">

            <!-- Loop Through Posts Here -->
            @foreach($posts as $post)
            <article id="post-{{ $post->id }}" class="flex flex-col overflow-hidden rounded-lg shadow-lg" typeof="Article">

                <meta property="name" content="{{ $post->title }}">
                <meta property="author" typeof="Person" content="admin">
                <meta property="dateModified" content="{{ Carbon\Carbon::parse($post->updated_at)->toIso8601String() }}">
                <meta class="uk-margin-remove-adjacent" property="datePublished" content="{{ Carbon\Carbon::parse($post->created_at)->toIso8601String() }}">

                <div class="flex-shrink-0">
                    <a href="{{ $post->link() }}">
                        <img class="object-cover w-full h-48" src="{{ $post->image() }}" alt="">
                    </a>
                </div>
                <div class="relative flex flex-col justify-between flex-1 p-6 bg-white">
                    <div class="flex-1">
                        <a href="{{ $post->link() }}" class="block">
                            <h3 class="mt-2 text-xl font-semibold leading-7 text-gray-900">
                                {{ $post->title }}
                            </h3>
                        </a>
                        <a href="{{ $post->link() }}" class="block">
                            <p class="mt-3 text-base leading-6 text-gray-500">
                                {{ substr(strip_tags($post->body), 0, 200) }}@if(strlen(strip_tags($post->body)) > 200){{ '...' }}@endif
                            </p>
                        </a>
                    </div>
                    <p class="relative self-start inline-block px-2 py-1 mt-4 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded">
                        <a href="{{ route('wave.blog.category', $post->category->slug) }}" class="text-gray-700 hover:underline" rel="category">
                            {{ $post->category->name }}
                        </a>
                    </p>
                </div>

                <div class="flex items-center p-6 bg-gray-50">
                    <div class="flex-shrink-0">
                        <div>
                            <img class="w-10 h-10 rounded-full" src="{{ $post->user->avatar() }}" alt="">
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium leading-5 text-gray-900">
                            {{ __('messages.Blog.writtenBy') }} <div class="hover:underline">{{ $post->user->name }}</div>
                        </p>
                        <div class="flex text-sm leading-5 text-gray-500">
                            {{ __('messages.Blog.dateOfPublish') }} <time datetime="{{ Carbon\Carbon::parse($post->created_at)->toIso8601String() }}" class="ml-1">{{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}</time>
                        </div>
                    </div>
                </div>

            </article>
            @endforeach
            <!-- End Post Loop Here -->

        </div>
    </div>

    <div class="flex justify-center my-10">
        {{ $posts->links('theme::partials.pagination') }}
        <!--li class="uk-active"><span aria-current="page" class="page-numbers current">1</span></li>
		<li><a class="page-numbers" href="https://demo.yootheme.com/themes/wordpress/2017/copper-hill/?paged=2&amp;page_id=92">2</a></li>
		<li><a class="next page-numbers" href="https://demo.yootheme.com/themes/wordpress/2017/copper-hill/?paged=2&amp;page_id=92"><span uk-pagination-next="" class="uk-pagination-next uk-icon"><svg width="7" height="12" viewBox="0 0 7 12" xmlns="http://www.w3.org/2000/svg" ratio="1"><polyline fill="none" stroke="#000" stroke-width="1.2" points="1 1 6 6 1 11"></polyline></svg></span></a></li-->
        </ul>

    </div>

    @endsection