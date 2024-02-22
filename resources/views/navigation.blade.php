@guest
@else
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name">Blogs</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('dashboard') }}">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-folder-plus'></i>
                        <span class="link_name">Blog</span>
                    </a>
                    <i class='bx bx-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Blog</a></li>
                    <li><a href="{{ route('blogs') }}">Blogs</a></li>
                    <li><a href="{{ route('add-blog') }}">Blog Aanmaken</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('userpage') }}">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Gebruikers</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('userpage') }}">Gebruikers</a></li>
                </ul>
            </li>


            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <a href="{{ route('profile') }}"><img
                                src="/public/images/profile_picures/{{ Auth::user()->profile_picure }}" alt="profile"></a>
                    </div>
                    <div class="name-job">
                        <div class="profile_name"><a href="{{ route('profile') }}">{{ Str::ucfirst(Auth::user()->name) }}</a></div>
                        <div class="job">Blogger</div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        <input name="_method" type="hidden" value="GET">
                        <button style="submit" class="btnlogout show_confirm" data-toggle="tooltip" title='Delete'><i
                                class='bx bx-log-out'></i>
                    </form>
                </div>
            </li>
        </ul>
    </div>

    <section class="nav-section">
        <div class="home-nav">
            <i class='bx bx-menu'></i>
            <span class="text">Navigatie</span>
        </div>
    </section>

    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Weet je zeker dat je wilt uitloggen?`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    position: 'top-start',
                    buttons: ["Nee", "Ja"],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        }

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("gesloten");
        });
    </script>
@endguest
