const express = require('express');
const router = express();
const Song = require('../classes/Song');

const genericSongBody = {
    attributes: {
        exclude: ["createdAt", "updatedAt"]
    }
}

router.get('/:band_idband', (req, res) => {
    Song.findAll({
        ...genericSongBody,
        where: {
            band_idband: req.params.band_idband
        }
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

router.get('/id/:idsong', (req, res) => {
    Song.findAll({
        ...genericSongBody,
        where: {
            idsong: req.params.idsong
        }
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

module.exports = router