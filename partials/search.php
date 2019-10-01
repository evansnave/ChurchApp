<div class="main-search">
    <form action="operations/search.php" method="post" onsubmit="return search();">
        <div class="input-group" style="width:250px;">
            <input type="text" id="search_data" name="search_data" class="form-control" width="500px" placeholder="Find first timer" onkeyup="search();">
            <a href="javascript:" class="input-group-append search-close">
                <i class="feather icon-x input-group-text"></i>
            </a>
            <span class="input-group-append search-btn btn btn-primary">
                <i class="feather icon-search input-group-text"></i>
            </span>
        </div>
    </form>
</div>