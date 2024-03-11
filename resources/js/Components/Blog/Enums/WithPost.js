const WithPostEnum = Object.freeze({
    ALL: 'all',
    WITH: 'with',
    WITHOUT: 'without',
})

const WithPostTitles = Object.freeze({
    [WithPostEnum.ALL]: 'All',
    [WithPostEnum.WITH]: 'With posts',
    [WithPostEnum.WITHOUT]: 'Without posts',
})

export {WithPostEnum, WithPostTitles};
