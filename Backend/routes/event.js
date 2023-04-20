const express = require('express');
const router = express();
const Event = require('../classes/Event');

const genericEventBody = {

}

router.get('/:band_idband/date/:current_date', (req, res) => {
    Event.findAll({
        // where: {
        //     band_idband: req.params.band_idband
        // }
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

module.exports = router