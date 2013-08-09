this["Templates"] = this["Templates"] || {};

this["Templates"]["main-navigation--typeahead-header"] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<div class=\"tt-suggestions-title\">");_.b("\n" + i);_.b("	<h2>");_.b(_.v(_.f("name",c,p,0)));_.b("</h2>");_.b("\n" + i);_.b("</div>");return _.fl();;});

this["Templates"]["main-navigation--typeahead-result"] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<a href=\"");_.b(_.v(_.f("url",c,p,0)));_.b("\">");_.b(_.v(_.f("title",c,p,0)));_.b("</a>");return _.fl();;});

this["Templates"]["notifications--message"] = new Hogan.Template(function(c,p,i){var _=this;_.b(i=i||"");_.b("<div class=\"notifications-message notifications-message__");_.b(_.v(_.f("tone",c,p,0)));_.b("\" id=\"notification-");_.b(_.v(_.f("id",c,p,0)));_.b("\">");_.b("\n" + i);_.b("	");_.b(_.v(_.f("message",c,p,0)));_.b("\n" + i);_.b("	<a href=\"#notification-");_.b(_.v(_.f("id",c,p,0)));_.b("\" class=\"notifications-message--dismiss\">&times;</a>");_.b("\n" + i);_.b("</div> ");return _.fl();;});