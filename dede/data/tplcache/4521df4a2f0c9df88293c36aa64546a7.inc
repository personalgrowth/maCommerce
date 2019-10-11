[field:global name=autoindex runphp='yes']

					((@me%2)!=0)? @me="<div class="itemModule moduleImg">":@me="<div class="itemModule moduleVideo"></li>";

				[/field:global]
	                <a href="view.php?aid=[field:id/]">
	                   	[field:image /]
	                    <div class="introduce">[field:title /]</div>
	                </a>
	            </div>