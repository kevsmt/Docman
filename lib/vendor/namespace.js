(function (context) {

	/**
     * namespace
     * @param arguments
     */
	function namespace ()
	{
		var args = arguments,
		parent = window,
		aDomains,
		oDomain,
		oSubDomain,

		createNs = function (ns)
		{
			aDomains = ns.split(".");
			oDomain = parent;

			for (var i = 0; i < aDomains.length; i++) {
				oSubDomain = aDomains[i];

				if (typeof oDomain[oSubDomain] === 'undefined')
					oDomain[oSubDomain] = {};

				oDomain = oDomain[oSubDomain];
			}
		};

		// check if first argument is an object, if its an object make it
		// as a parent for namespace. MyFirsArgument.[Namespaces.Namespaces.Namespaces]...

		for (var j = 0; j < args.length; j++) {
			if (j == 0) {
				if (typeof args[j] == "object") {
					parent = args[j];
					continue;
				}
			}
			createNs(args[j]);
		}
	};

	context.namespace = context.ns = namespace;

})(this);