<?php
function setActiveRoute($name)
{
	return request()->routeIs($name) ? 'active' : '';
}

function setActiveCollapse($menu)
{
	return request()->routeIs($menu) ? 'menu-open' : '';
}
