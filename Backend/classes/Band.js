const Sequelize = require('sequelize')
const db = require('../connection')
const Song = require('./Song')
const Event = require('./Event')

const Band = db.define('band', {
    idband: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    name: {
        type: Sequelize.STRING
    },
    location: {
        type: Sequelize.STRING
    }
}, {tableName: 'band'})

/** Relation Band-Song **/
Band.hasMany(Song, {
    foreign_key: "band_idband"
})

Song.belongsTo(Band, {
    foreign_key: "band_idband"
})

/** Relation Band-Event **/
Band.hasMany(Event, {
    foreign_key: "band_idband"
})

Event.belongsTo(Band, {
    foreign_key: "band_idband"
})

module.exports = Band