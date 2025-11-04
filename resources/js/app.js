// Data Film/Movie
const movies = [
  { title: 'KEADILAN', genre: 'Action' },
  { title: 'Ada Apa Cinta', genre: 'Romance' },
  { title: 'Merah Putih One For All', genre: 'Animation' },
  { title: 'JOKER', genre: 'Horror' },
  { title: 'SEKAWAN LIMO', genre: 'Comedy' },
  { title: 'AGAK LAEN', genre: 'Comedy' },
  { title: 'INCEPTION', genre: 'Action' },
  { title: 'THE NOTEBOOK', genre: 'Romance' },
  { title: 'GET OUT', genre: 'Horror' }
];

// Manajemen State
let currentFilter = 'action';
let searchQuery = '';

// Render Movies (filter film)
function renderMovies() {
  const moviesGrid = document.getElementById('moviesGrid');
  
  let filteredMovies = movies;
  
  if (currentFilter && currentFilter !== 'all') {
    filteredMovies = filteredMovies.filter(movie => 
      movie.genre.toLowerCase() === currentFilter.toLowerCase()
    );
  }
  
  if (searchQuery) {
    filteredMovies = filteredMovies.filter(movie => 
      movie.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
      movie.genre.toLowerCase().includes(searchQuery.toLowerCase())
    );
  }
  
  if (filteredMovies.length === 0) {
    filteredMovies = movies;
  }
  
  moviesGrid.innerHTML = filteredMovies.map(movie => `
    <div class="movie-card">
      <div class="movie-poster">
        <div class="movie-poster-overlay">
          <div class="play-btn">
            <i class="fas fa-play"></i>
          </div>
        </div>
      </div>
      <div class="movie-info">
        <h3 class="movie-title">${movie.title}</h3>
        <p class="movie-genre">${movie.genre}</p>
      </div>
    </div>
  `).join('');
}

// Genre filter functionality
function initGenreFilters() {
  const genreBtns = document.querySelectorAll('.genre-btn:not(.genre-more)');
  
  genreBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      genreBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      
      currentFilter = btn.dataset.genre;
      
      renderMovies();
    });
  });
}

// Function search
function initSearch() {
  const searchInput = document.getElementById('searchInput');
  
  searchInput.addEventListener('input', (e) => {
    searchQuery = e.target.value;
    renderMovies();
  });
}

// Function tombol User (dropdown)
function initUserDropdown() {
  const userProfileBtn = document.getElementById('userProfileBtn');
  const userDropdown = document.getElementById('userDropdown');
  
  userProfileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    userDropdown.classList.toggle('show');
  });
  
  // Close dropdown when clicking outside
  document.addEventListener('click', (e) => {
    if (!userDropdown.contains(e.target) && e.target !== userProfileBtn) {
      userDropdown.classList.remove('show');
    }
  });
}

// Funtion untuk Navbar
function initNavigation() {
  const navItems = document.querySelectorAll('.nav-item');
  
  navItems.forEach(item => {
    item.addEventListener('click', (e) => {
      if (item.id === 'registerLoginBtn') return;
      
      e.preventDefault();
      
      // Hapus Active Class dari semua Navbar
      navItems.forEach(nav => nav.classList.remove('active'));
      
      // Menambahkan Active Class ke Tombol
      item.classList.add('active');
    });
  });
}

// Tombol "Watch Trailer"
function initTrailerButton() {
  const trailerBtn = document.querySelector('.btn-watch-trailer');
  
  trailerBtn.addEventListener('click', () => {
    alert('Video trailer akan muncul disini!');
  });
}

// Tombol Register/Login
function initAuthButtons() {
  const registerLoginBtn = document.getElementById('registerLoginBtn');
  const dropdownItems = document.querySelectorAll('.dropdown-item');
  
  registerLoginBtn.addEventListener('click', () => {
    window.location.href = '/login';
  });
  
  dropdownItems.forEach(item => {
    item.addEventListener('click', (e) => {
    e.preventDefault();
    const action = item.querySelector('span').textContent;
    if (action === 'Login') {
        window.location.href = '/login';
    } else if (action === 'Register') {
        window.location.href = '/register';
    }
    });
  });
}

// Tombol Notif
function initNotificationButton() {
  const notificationBtn = document.getElementById('notificationBtn');
  
  notificationBtn.addEventListener('click', () => {
    alert('Notifikasi akan muncul disini!');
  });
}

// Function Movie Card
function initMovieCards() {
  const moviesGrid = document.getElementById('moviesGrid');
  
  moviesGrid.addEventListener('click', (e) => {
    const movieCard = e.target.closest('.movie-card');
    if (movieCard) {
      const movieTitle = movieCard.querySelector('.movie-title').textContent;
      alert(`Kamu memilih: ${movieTitle}\n\nIni akan menunjukan detail booking film!`);
    }
  });
}

// Inisialisasi semua fungsi setelah memuat DOM
document.addEventListener('DOMContentLoaded', () => {
  renderMovies();
  initGenreFilters();
  initSearch();
  initUserDropdown();
  initNavigation();
  initTrailerButton();
  initAuthButtons();
  initNotificationButton();
  initMovieCards();
});