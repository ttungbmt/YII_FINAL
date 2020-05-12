
export const cir2poly = (center, radius = 200, parts = 200) => {
    return LGeo.circle(center, radius, {parts});
}

// array polygon GEOJSON
export const mergePoly = (poly) => {
    return turf.merge(turf.featurecollection(poly));
}

export const geoJSON2WKT = (geoJSON) => {
    let wkt = new Wkt.Wkt();
    let wktStr;
    try {
        wktStr = wkt.read(JSON.stringify(geoJSON)).write();
    } catch (e) { return null; }

    return  wktStr;
}

// polygon GEOJSON Feature collection
export const pointInPolygon = (location, polygon) => {
    let pt = L.marker(location).toGeoJSON();
    return polygon.features.filter(val => turf.inside(pt, val))
}

// polyMain (GEOJSON Feature) - polyArr (GEOJSON Feature collection)
export const polygonNearest = (polyMain, polyArr) => {
    return polyArr.features.filter(val => turf.intersect(polyMain, val))
}



