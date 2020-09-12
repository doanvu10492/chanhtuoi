<form method="get" class="td-search-form" action="/tim-kiem" class="form-group">
	<div role="search" class="td-head-form-search-wrap">
		<div class="input-group">
			<input id="td-header-search" type="text" placeholder=" Tìm kiếm " value="<?= (isset($keyword)) ? ($keyword) : ('')?>" name="keyword" autocomplete="off" class="form-control">
			<span class="input-group-addon"><input  type="submit" name="searchsubmit" id="td-header-search-top" value=" "></span>
		</div>
			<div class="search-offer">
			<p>Tìm nhiều:</p>
			<a href="/tim-kiem?keyword=shopee">shopee</a>,
			<a href="/tim-kiem?keyword=lazada">lazada</a>,
			<a href="/tim-kiem?keyword=tiki">tiki</a>, ...
		</div>
	</div>
</form>