const express = require('express');
const router = express();
const Band = require('../classes/Band');

const genericBandBody = {
    attributes: {
        exclude: ["createdAt", "updatedAt"]
    }
}

/** GET ALL USERS **/
router.get('/', (req, res) => {
    Band.findAll(genericBandBody)
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

module.exports = router;