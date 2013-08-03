this["Templates"] = this["Templates"] || {};

this["Templates"]["main-navigation--typeahead-header"] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<div class=\"tt-suggestions-title\">");_.b("\n" + i);_.b("	<h2>");_.b(_.v(_.f("name",c,p,0)));_.b("</h2>");_.b("\n" + i);_.b("</div>");return _.fl();;});

this["Templates"]["main-navigation--typeahead-result"] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<a href=\"");_.b(_.v(_.f("url",c,p,0)));_.b("\">");_.b(_.v(_.f("title",c,p,0)));_.b("</a>");return _.fl();;});