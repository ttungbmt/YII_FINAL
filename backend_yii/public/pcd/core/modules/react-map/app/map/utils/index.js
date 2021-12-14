export const invertBound = (geojson) => {
    let state = geojson.features[0];
    state.geometry.coordinates = [
        // the world
        [
            [-180, -90],
            [-180, 90],
            [180, 90],
            [180, -90],
            [-180, -90]
        ],
        // the state
        state.geometry.coordinates[0]
    ];

    return state;
}