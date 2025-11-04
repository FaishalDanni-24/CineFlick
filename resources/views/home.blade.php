@extends('layouts.app')

@section('content')
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-content">
            <div class="sidebar-header">
                <div class="logo">
                    <span class="logo-text">CineFlick</span>
                </div>
                <div class="user-greeting">
                    @auth
                        <p class="greeting-text">Hello, {{ Auth::user()->name }}!</p>
                    @else
                        <p class="greeting-text">Hello, Guest!</p>
                    @endauth
                    <span class="badge">Cilegon</span>
                </div>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('home') }}" class="nav-item active">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-film"></i>
                    <span>Movie</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-utensils"></i>
                    <span>Food &amp; Drink</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-clock"></i>
                    <span>History</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="#" class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Setting</span>
                </a>
                @guest
                    <a href="{{ route('login') }}" class="btn-register">
                        <i class="fas fa-user-plus"></i>
                        <span>Register / Login</span>
                    </a>
                @endguest
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search Movie, Genre, and Others" class="search-input">
            </div>
            
            <div class="genre-filters">
                <button class="genre-btn active" data-genre="action">Action</button>
                <button class="genre-btn" data-genre="romance">Romance</button>
                <button class="genre-btn" data-genre="comedy">Comedy</button>
                <button class="genre-btn" data-genre="horror">Horror</button>
                <button class="genre-btn genre-more">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="header-actions">
                <button class="icon-btn" id="notificationBtn">
                    <i class="fas fa-bell"></i>
                </button>
                @auth
                    <div class="user-profile-wrapper">
                        <button class="icon-btn user-profile-btn" id="userProfileBtn">
                            <i class="fas fa-user-circle"></i>
                        </button>
                        <div class="dropdown-menu" id="userDropdown">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="user-profile-wrapper">
                        <button class="icon-btn user-profile-btn" id="userProfileBtn">
                            <i class="fas fa-user-circle"></i>
                        </button>
                        <div class="dropdown-menu" id="userDropdown">
                            <a href="{{ route('login') }}" class="dropdown-item">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Login</span>
                            </a>
                            <a href="{{ route('register') }}" class="dropdown-item">
                                <i class="fas fa-user-plus"></i>
                                <span>Register</span>
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </header>

        <!-- Fitur Trailer -->
        <section class="featured-trailer">
            <div class="trailer-overlay">
                <div class="trailer-content">
                    <span class="trailer-subtitle">OFFICIAL TRAILER</span>
                    <h1 class="trailer-title">#MALAMJUMAT THE MOVIE</h1>
                    <p class="trailer-description">A thrilling Indonesian movie experience</p>
                    <button class="btn-watch-trailer">
                        <i class="fas fa-play"></i>
                        <span>Watch Trailer</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Movie Grid -->
        <section class="movies-section">
            <h2 class="section-title">Now Showing</h2>
            <div class="movies-grid" id="moviesGrid">
            </div>
        </section>
    </main>
@endsection