export default class Controller {
  constructor() {
    
  }

  async getAnswerIfExits(url, email) {
    return fetch(`${url}request/?req=exist_answers&email=${email}`)
      .then(answers => answers.json());
  }
}