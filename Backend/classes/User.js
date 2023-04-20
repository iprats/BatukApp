const Sequelize = require('sequelize')
const db = require('../connection')
const Band = require('./Band')
const Instrument = require('./Instrument')
const BandHasUser = require('./BandHasUser')

const User = db.define('user', {
    iduser: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    name: {
        type: Sequelize.STRING
    },
    email: {
        type: Sequelize.STRING
    },
    dni: {
        type: Sequelize.INTEGER
    },
    instrument_idinstrument: {
        type: Sequelize.INTEGER,
        references: {

        }
    }
}, {tableName: 'user'})

/** Relation User-Instrument **/
User.belongsTo(Instrument, {
    foreignKey: "instrument_idinstrument"
})

Instrument.hasMany(User, {
    foreignKey: "instrument_idinstrument"
})

/** Relation User-Band through BandHasUser **/
Band.belongsToMany(User, {
    through: BandHasUser,
    foreignKey: "band_idband"
})

User.belongsToMany(Band, {
    through: BandHasUser,
    foreignKey: "user_iduser"
})

module.exports = User