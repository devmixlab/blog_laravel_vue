const TopEnum = Object.freeze({
    ALL: 'all',
    ONLY_TOP: 'only_top',
    ONLY_NOT_TOP: 'only_not_top',
})

const TopTitles = Object.freeze({
    [TopEnum.ALL]: 'All',
    [TopEnum.ONLY_TOP]: 'Only top',
    [TopEnum.ONLY_NOT_TOP]: 'Only not top',
})

export {TopEnum, TopTitles};
